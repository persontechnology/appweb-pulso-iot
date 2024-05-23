<?php

namespace App\Http\Controllers\Api;

use App\Events\LecturaGuardadoEvent;
use App\Http\Controllers\Controller;
use App\Models\Dispositivo;
use App\Models\Horario;
use App\Models\Lectura;
use App\Notifications\EnviarEmailUsuariosAsignadosLectura;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;

class GatewayController extends Controller
{
    public function sensor(Request $request)
    {
        // error_log($request);
        try {
            // Obtener la información del dispositivo y del objeto de la solicitud
            $deviceInfo = $request->json('deviceInfo');
            $object = $request->json('object');
            
            // Verificar si se recibieron los datos del dispositivo y del objeto
            if (!$deviceInfo || !$object) {
                throw new \Exception('NO EXISTE DEVICE INFO O OBJECT');
            }
            
            

            // $object={"battery":90,press:50}	
            

            if(!array_key_exists('battery',$object)){
                $lectura = $this->crearLectura($deviceInfo['devEui'], $object);
                // Emitir un evento para notificar la lectura guardada en tiempo real
                event(new LecturaGuardadoEvent('PERFECTO FUNCIONO NOTIFICACION EN TEIMPO REAL'));
                error_log('ENTRO LA LECTURA');
            }else{
                error_log('NO SE CREO LA LECTURA PORQUE ENTRO BATTERY');
            }
            
            
            

        } catch (\Throwable $th) {
            // Capturar cualquier excepción y registrarla en los registros de errores
            error_log('OCURRIO UN ERROR: ' . $th->getMessage());
        }
    }

    public function crearLectura($dev_eui, $object)
    {
        // Crear una nueva instancia de Lectura y guardarla en la base de datos
        
        $lectura = new Lectura();
        $lectura->dev_eui =$dev_eui;
        $lectura->data = json_encode($object);
        $lectura->save();
        return $lectura;
    }


    public function obtenerLecturaActivo(){
         $lec= Lectura::where('estado',true)->latest()->first();
         
        if($lec){
            $dev_eui =$lec->xId($lec->id)->dev_eui;
            
            $nombres= $lec->buscarDispositivoDevEui($dev_eui)->user->nombres??'';
            $apellidos= $lec->buscarDispositivoDevEui($dev_eui)->user->apellidos??'';
        
            $data = array(
                'estado'=>1,
                'id'=>$lec->id,
                'texto'=>$apellidos.' '.$nombres.', necesita ayuda.! '
            );
            return json_encode($data);
        }else{
            return json_encode(['estado'=>0,'id'=>0,'texto'=>'']);
        }
    }


    public function cambiarEstadoLectura(Request $request) {
        error_log($request->id);
        $lec=Lectura::find($request->id);
        $lec->estado=false;
        $lec->save();
        
        return json_encode('ok');
    }


}
