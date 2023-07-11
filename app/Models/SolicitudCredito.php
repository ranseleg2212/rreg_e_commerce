<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudCredito extends Model
{
    use HasFactory;
    protected $fillable = [
        'estado_solicitud',
        'comentario',
        'monto_solicitado',
        //DATOS DEL SOLICITANTE
        'nombres_solicitante',
        'apellidos_solicitante',
        'ocupacion_solicitante',
        'nacimiento_solicitante',
        'direccion_solicitante',
        'tel_residencial_solicitante',
        'referencia_ubicacion_solicitante',
        'tel_celular_solicitante',
        'monto_alquiler_solicitante',
        'tipo_vivienda_solicitante',
        'apodo_solicitante',
        'estado_civil_solicitante',
        'cedula_pasaporte_solicitante',
        'vehiculo_solicitante',
        'marca_vehiculo_solicitante',
        'correo_solicitante',
        //NEGOCIO DEL SOLICITANTE
        'nombre_negocio_solicitante',
        'tel_negocio_solicitante',
        'tipo_garantia_negocio_solicitante',
        'direccion_negocio_solicitante',
        'empleados_negocio_solicitante',
        'monto_alquiler_negocio_solicitante',
        'tipo_local_negocio_solicitante',
        'tiempo_negocio_solicitante',
        'ventas_diarias_negocio_solicitante',
        'otro_negocio_solicitante',
        //DATOS LABORALES
        'empresa_laboral_solicitante',
        'tipo_empresa_laboral_solicitante',
        'direccion_empresa_laboral_solicitante',
        'tel_empresa_laboral_solicitante',
        'cargo_laboral_solicitante',
        'salario_laboral_solicitante',
        'tiempo_laboral_solicitante',
        'nombre_jefe_laboral_solicitante',
        //CONYUGUE
        'nombres_conyugue_solicitante',
        'apellidos_conyugue_solicitante',
        'cedula_conyugue_solicitante',
        'trabajo_conyugue_solicitante',
        'direccion_trabajo_conyugue_solicitante',
        'direccion_residencial_conyugue_solicitante',
        'tel_trabajo_conyugue_solicitante',
        'tel_celular_conyugue_solicitante',
        'ingresos_conyugue_solicitante',
        //FAMILIARES QUE NO VIVAN CON EL SOLICITANTE
        //*familiar 1
        'nombre_familiar_uno',
        'parentesco_familiar_uno',
        'tel_familiar_uno',
        'direccion_familiar_uno',
        //*familiar 2
        'nombre_familiar_dos',
        'parentesco_familiar_dos',
        'tel_familiar_dos',
        'direccion_familiar_dos',
        //CO-DEUDORES
        //*codeudor 1
        'nombres_codeudor_uno',
        'apellidos_codeudor_uno',
        'nacimiento_codeudor_uno',
        'direccion_codeudor_uno',
        'referencia_ubicacion_codeudor_uno',
        'tel_residencial_codeudor_uno',
        'tel_celular_codeudor_uno',
        'tipo_vivienda_codeudor_uno',
        'monto_alquiler_codeudor_uno',
        'apodo_codeudor_uno',
        'cedula_pasaporte_codeudor_uno',
        'ocupacion_codeudor_uno',
        'vehiculo_codeudor_uno',
        'marca_vehiculo_codeudor_uno',
        'estado_civil_codeudor_uno',
        //!negocio codeudor 1
        'nombre_negocio_codeudor_uno',
        'direccion_negocio_codeudor_uno',
        'ventas_negocio_codeudor_uno',
        'tipo_local_negocio_codeudor_uno',
        //*codeudor 2
        'nombres_codeudor_dos',
        'apellidos_codeudor_dos',
        'nacimiento_codeudor_dos',
        'direccion_codeudor_dos',
        'referencia_ubicacion_codeudor_dos',
        'tel_residencial_codeudor_dos',
        'tel_celular_codeudor_dos',
        'tipo_vivienda_codeudor_dos',
        'monto_alquiler_codeudor_dos',
        'apodo_codeudor_dos',
        'cedula_pasaporte_codeudor_dos',
        'ocupacion_codeudor_dos',
        'vehiculo_codeudor_dos',
        'marca_vehiculo_codeudor_dos',
        'estado_civil_codeudor_dos',
        //!negocio codeudor 2
        'nombre_negocio_codeudor_dos',
        'direccion_negocio_codeudor_dos',
        'ventas_negocio_codeudor_dos',
        'tipo_local_negocio_codeudor_dos',
    ];
}
