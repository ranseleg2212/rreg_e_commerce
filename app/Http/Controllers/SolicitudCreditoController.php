<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ConfirmationShopping;
use App\Mail\NotificacionSolicitudMail;
use Illuminate\Support\Facades\Mail;
use App\Models\SolicitudCredito;
use Illuminate\Support\Facades\DB;

class SolicitudCreditoController extends Controller
{
    public function formulario()
    {
        return view('livewire.financiamiento')
            ->extends('layouts.app')
            ->section('content');
    }

    public function create(Request $request, SolicitudCredito $sc)
    {
        $sc->estado_solicitud = $request->solicitud_nr_slct;
        $sc->monto_solicitado = $request->monto_solicitado_txt;
        $sc->nombres_solicitante = $request->nombre_txt;
        $sc->apellidos_solicitante = $request->apellido_txt;
        $sc->ocupacion_solicitante = $request->ocupacion_txt;
        $sc->nacimiento_solicitante = $request->nacimiento_date;
        $sc->direccion_solicitante = $request->direccion_txt;
        $sc->tel_residencial_solicitante = $request->telefono_txt;
        $sc->referencia_ubicacion_solicitante = $request->referencia_ubicacion_txt;
        $sc->tel_celular_solicitante = $request->celular_txt;
        $sc->monto_alquiler_solicitante = $request->pago_alquiler_txt;
        $sc->tipo_vivienda_solicitante = $request->tipo_vivienda_slct;
        $sc->apodo_solicitante = $request->apodo_txt;
        $sc->estado_civil_solicitante = $request->estado_civil_slct;
        $sc->cedula_pasaporte_solicitante = $request->cedula_pasaporte_txt;
        $sc->vehiculo_solicitante = $request->vehiculo_slct;
        $sc->marca_vehiculo_solicitante = $request->marca_vehiculo_txt;
        $sc->correo_solicitante = $request->email_txt;
        //!NEGOCIO SOLICITANTE
        $sc->nombre_negocio_solicitante = $request->nombre_negocio_txt;
        $sc->tel_negocio_solicitante = $request->telefono_negocio_txt;
        $sc->tipo_garantia_negocio_solicitante = $request->tipo_garantia_slct;
        $sc->direccion_negocio_solicitante = $request->direccion_negocio_txt;
        $sc->empleados_negocio_solicitante = $request->cantidad_empleados_txt;
        $sc->monto_alquiler_negocio_solicitante = $request->monto_pago_alquiler_local_txt;
        $sc->tipo_local_negocio_solicitante = $request->tipo_local_slct;
        $sc->tiempo_negocio_solicitante = $request->tiempo_negocio_txt;
        $sc->ventas_diarias_negocio_solicitante = $request->ventas_diarias_txt;
        $sc->otro_negocio_solicitante = $request->otro_negocio_txt;
        //!DATOS LABORALES
        $sc->empresa_laboral_solicitante = $request->nombre_empresa_txt;
        $sc->tipo_empresa_laboral_solicitante = $request->tipo_empresa_txt;
        $sc->direccion_empresa_laboral_solicitante = $request->direccion_empresa_txt;
        $sc->tel_empresa_laboral_solicitante = $request->telefonos_empresa_txt;
        $sc->cargo_laboral_solicitante = $request->cargo_empresa_txt;
        $sc->salario_laboral_solicitante = $request->salario_txt;
        $sc->tiempo_laboral_solicitante = $request->tiempo_laborando_txt;
        $sc->nombre_jefe_laboral_solicitante = $request->nombre_jefe_txt;
        //!CONYUGUE
        $sc->nombres_conyugue_solicitante = $request->nombre_conyugue_txt;
        $sc->apellidos_conyugue_solicitante = $request->apellido_conyugue_txt;
        $sc->cedula_conyugue_solicitante = $request->cedula_conyugue_txt;
        $sc->trabajo_conyugue_solicitante = $request->trabajo_conyugue_txt;
        $sc->direccion_trabajo_conyugue_solicitante = $request->direccion_trabajo_conyugue_txt;
        $sc->direccion_residencial_conyugue_solicitante = $request->direccion_conyugue_txt;
        $sc->tel_trabajo_conyugue_solicitante = $request->telefonos_trabajo_conyugue_txt;
        $sc->tel_celular_conyugue_solicitante = $request->celular_conyugue_txt;
        $sc->ingresos_conyugue_solicitante = $request->ingresos_conyugue_txt;
        //!FAMILIARES NO CERCANOS
        //*familiar 1
        $sc->nombre_familiar_uno = $request->nombre_apellido_familiar_uno_txt;
        $sc->parentesco_familiar_uno = $request->parentesco_familiar_uno_txt;
        $sc->tel_familiar_uno = $request->telefono_familiar_uno_txt;
        $sc->direccion_familiar_uno = $request->direccion_familiar_uno_txt;
        //*familiar 2
        $sc->nombre_familiar_dos = $request->nombre_apellido_familiar_dos_txt;
        $sc->parentesco_familiar_dos = $request->parentesco_familiar_dos_txt;
        $sc->tel_familiar_dos = $request->telefono_familiar_dos_txt;
        $sc->direccion_familiar_dos = $request->direccion_familiar_dos_txt;
        //!CO-DEUDORES
        //*co-deudor 1
        $sc->nombres_codeudor_uno = $request->nombres_codeudor_uno_txt;
        $sc->apellidos_codeudor_uno = $request->apellidos_codeudor_uno_txt;
        $sc->nacimiento_codeudor_uno = $request->nacimiento_codeudor_uno_date;
        $sc->direccion_codeudor_uno = $request->direccion_codeudor_uno_txt;
        $sc->referencia_ubicacion_codeudor_uno = $request->referencia_ubicacion_codeudor_uno_txt;
        $sc->tel_residencial_codeudor_uno = $request->telefono_codeudor_uno_txt;
        $sc->tel_celular_codeudor_uno = $request->celular_codeudor_uno_txt;
        $sc->tipo_vivienda_codeudor_uno = $request->tipo_vivienda_codeudor_uno_txt;
        $sc->monto_alquiler_codeudor_uno = $request->pago_alquiler_codeudor_uno_txt;
        $sc->apodo_codeudor_uno = $request->apodo_codeudor_uno_txt;
        $sc->cedula_pasaporte_codeudor_uno = $request->cedula_codeudor_uno_txt;
        $sc->ocupacion_codeudor_uno = $request->ocupacion_codeudor_uno_txt;
        $sc->vehiculo_codeudor_uno = $request->vehiculo_codeudor_uno_slct;
        $sc->marca_vehiculo_codeudor_uno = $request->marca_vehiculo_codeudor_uno_txt;
        $sc->estado_civil_codeudor_uno = $request->estado_civil_codeudor_uno_slct;
        //?negocio codeudor 1
        $sc->nombre_negocio_codeudor_uno = $request->negocio_codeudor_uno_txt;
        $sc->direccion_negocio_codeudor_uno = $request->direccion_negocio_codeudor_uno_txt;
        $sc->ventas_negocio_codeudor_uno = $request->ventas_diarias_codeudor_uno_txt;
        $sc->tipo_local_negocio_codeudor_uno = $request->tipo_local_codeudor_uno_txt;
        //!CO-DEUDOR 2
        $sc->nombres_codeudor_dos = $request->nombres_codeudor_dos_txt;
        $sc->apellidos_codeudor_dos = $request->apellidos_codeudor_dos_txt;
        $sc->nacimiento_codeudor_dos = $request->nacimiento_codeudor_dos_date;
        $sc->direccion_codeudor_dos = $request->direccion_codeudor_dos_txt;
        $sc->referencia_ubicacion_codeudor_dos = $request->referencia_ubicacion_codeudor_dos_txt;
        $sc->tel_residencial_codeudor_dos = $request->telefono_codeudor_dos_txt;
        $sc->tel_celular_codeudor_dos = $request->celular_codeudor_dos_txt;
        $sc->tipo_vivienda_codeudor_dos = $request->tipo_vivienda_codeudor_dos_txt;
        $sc->monto_alquiler_codeudor_dos = $request->pago_alquiler_codeudor_dos_txt;
        $sc->apodo_codeudor_dos = $request->apodo_codeudor_dos_txt;
        $sc->cedula_pasaporte_codeudor_dos = $request->cedula_codeudor_dos_txt;
        $sc->ocupacion_codeudor_dos = $request->ocupacion_codeudor_dos_txt;
        $sc->vehiculo_codeudor_dos = $request->vehiculo_codeudor_dos_slct;
        $sc->marca_vehiculo_codeudor_dos = $request->marca_vehiculo_codeudor_dos_txt;
        $sc->estado_civil_codeudor_dos = $request->estado_civil_codeudor_dos_slct;
        //?negocio codeudor 2
        $sc->nombre_negocio_codeudor_dos = $request->negocio_codeudor_dos_txt;
        $sc->direccion_negocio_codeudor_dos = $request->direccion_negocio_codeudor_dos_txt;
        $sc->ventas_negocio_codeudor_dos = $request->ventas_diarias_codeudor_dos_txt;
        $sc->tipo_local_negocio_codeudor_dos = $request->tipo_local_codeudor_dos_txt;
        $sc->save();
        session()->flash('message', 'Tu solicitud fue enviada, te estaremos contactando. Puede proceder con su pedido');
        Mail::to($sc->correo_solicitante)->send(new NotificacionSolicitudMail($sc));
        Mail::to('yamarlyherrera@gmail.com')->send(new NotificacionSolicitudMail($sc));
        Mail::to('marlenyshome1@gmail.com')->send(new NotificacionSolicitudMail($sc));
        return redirect('/');
    }
    public function mostrar(Request $request)
    {
        $texto = $request->texto;
        if ($texto == null) {
            return view('administrador.solicitudes', [
                'datos' => SolicitudCredito::orderBy('created_at','desc')->paginate(20)
            ]);
        } else {
            $datos = SolicitudCredito::where('nombres_solicitante', 'LIKE', '%' . $texto . '%')
            ->orWhere('apellidos_solicitante', 'LIKE', '%' . $texto . '%')
            ->orWhere('id', '=', $texto)
            ->orWhere('estado_solicitud', '=', $texto)
            ->orderBy('created_at','desc')
            ->paginate(20);
            return view('administrador.solicitudes', compact('texto', 'datos'));
        }
    }

    public function mostrar_uno($id)
    {
        return view('administrador.detalles_solicitud', [
            'solicitud' => SolicitudCredito::find($id)
        ]);
    }

    public function editar($id)
    {
        $solicitudCredito = SolicitudCredito::find($id);

        return view('administrador.editar_solicitud', compact('solicitudCredito'));
    }

    public function update(Request $request, SolicitudCredito $solicitudCredito)
    {
        //request()->validate(SolicitudCredito::$rules);

        $solicitudCredito->update($request->all());

        return view('administrador.solicitudes', [
            'datos' => SolicitudCredito::orderBy('created_at','desc')->paginate(20),
            session()->flash('messagesoli', 'Solicitud editada')
        ]);
    }

    public function anular(Request $razon, SolicitudCredito $solicitud)
    {
        $solicitud->estado_solicitud = "Anulada";
        $solicitud->comentario = $razon->anulacion;
        $solicitud->update($razon->all());
        // $solicitud->save();
        return view('administrador.solicitudes', [
            'datos' => SolicitudCredito::orderBy('created_at','desc')->paginate(20),
            session()->flash('messagesoli', 'Solicitud anulada')
        ]);
    }
}
