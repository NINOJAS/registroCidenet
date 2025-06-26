<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Empleados - Cidenet</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-6xl mx-auto" x-data="empleadoApp()" x-init="init()">
        <h1 class="text-3xl font-bold mb-6 text-center text-blue-800">Registro de Empleados - Cidenet</h1>

        <button @click="modal = true" class="bg-blue-800 hover:bg-blue-700 text-white px-4 py-2 rounded-md mb-4">
            Registrar Empleado
        </button>

        <!-- Modal -->
        <template x-if="modal">
            <div class="fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-2xl overflow-y-auto max-h-screen">
                    <h2 class="text-xl font-semibold mb-4 text-blue-700">Nuevo Empleado</h2>
                    <form @submit.prevent="submitForm" class="space-y-3">

                        <!-- Mensajes de error -->
                        <template x-if="Object.keys(errors).length > 0">
                            <div class="bg-red-100 text-red-700 p-3 rounded">
                                <ul>
                                    <template x-for="[campo, mensajes] of Object.entries(errors)">
                                        <li x-text="mensajes[0]"></li>
                                    </template>
                                </ul>
                            </div>
                        </template>
                        
                        <!-- Primer Apellido -->
                        <div>
                            <label for="primer_apellido" class="block text-sm font-medium">Primer Apellido</label>
                            <input type="text" id="primer_apellido" name="primer_apellido"
                                x-model="form.primer_apellido"
                                x-on:input="form.primer_apellido = form.primer_apellido.replace(/[^A-Z]/g, '').slice(0, 20)"
                                class="w-full p-2 border rounded uppercase focus:ring" required />
                        </div>

                        <!-- Segundo Apellido -->
                        <div>
                            <label for="segundo_apellido" class="block text-sm font-medium">Segundo Apellido</label>
                            <input type="text" id="segundo_apellido" name="segundo_apellido"
                                x-model="form.segundo_apellido"
                                x-on:input="form.segundo_apellido = form.segundo_apellido.replace(/[^A-Z]/g, '').slice(0, 20)"
                                class="w-full p-2 border rounded uppercase focus:ring" required />
                        </div>

                        <!-- Primer Nombre -->
                        <div>
                            <label for="primer_nombre" class="block text-sm font-medium">Primer Nombre</label>
                            <input type="text" id="primer_nombre" name="primer_nombre"
                                x-model="form.primer_nombre"
                                x-on:input="form.primer_nombre = form.primer_nombre.replace(/[^A-Z]/g, '').slice(0, 20)"
                                class="w-full p-2 border rounded uppercase focus:ring" required />
                        </div>

                        <!-- Otros Nombres -->
                        <div>
                            <label for="otros_nombres" class="block text-sm font-medium">Otros Nombres (opcional)</label>
                            <input type="text" id="otros_nombres" name="otros_nombres"
                                x-model="form.otros_nombres"
                                x-on:input="form.otros_nombres = form.otros_nombres.replace(/[^A-Z ]/g, '').slice(0, 50)"
                                class="w-full p-2 border rounded uppercase focus:ring" />
                        </div>

                        <!-- País de Empleo -->
                        <div>
                            <label for="pais_empleo" class="block text-sm font-medium">País de Empleo</label>
                            <select id="pais_empleo" name="pais_empleo"
                                x-model="form.pais_empleo"
                                class="w-full p-2 border rounded focus:ring" required>
                                <option value="" disabled selected>Selecciona un País</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Estados Unidos">Estados Unidos</option>
                            </select>
                        </div>

                        <!-- Tipo de Identificación -->
                        <div>
                            <label for="tipo_identificacion" class="block text-sm font-medium">Tipo de Identificación</label>
                            <select id="tipo_identificacion" name="tipo_identificacion"
                                x-model="form.tipo_identificacion"
                                class="w-full p-2 border rounded focus:ring" required>
                                <option value="" disabled selected>Seleccione una opción</option>
                                <option value="Cédula de Ciudadanía">Cédula de Ciudadanía</option>
                                <option value="Cédula de Extranjería">Cédula de Extranjería</option>
                                <option value="Pasaporte">Pasaporte</option>
                                <option value="Permiso Especial">Permiso Especial</option>
                            </select>
                        </div>

                        <!-- Número de Identificación -->
                        <div>
                            <label for="numero_identificacion" class="block text-sm font-medium">Número de Identificación</label>
                            <input type="text" id="numero_identificacion" name="numero_identificacion"
                                x-model="form.numero_identificacion"
                                x-on:input="form.numero_identificacion = form.numero_identificacion.replace(/[^a-zA-Z0-9\-]/g, '').slice(0, 20)"
                                class="w-full p-2 border rounded focus:ring" required />
                        </div>

                        <!-- Fecha de Ingreso -->
                        <div>
                            <label for="fecha_ingreso" class="block text-sm font-medium">Fecha de Ingreso</label>
                            <input type="date" id="fecha_ingreso" name="fecha_ingreso"
                                x-model="form.fecha_ingreso"
                                :max="new Date().toISOString().split('T')[0]"
                                :min="new Date(new Date().setMonth(new Date().getMonth() - 1)).toISOString().split('T')[0]"
                                class="w-full p-2 border rounded focus:ring" required>
                        </div>

                        <!-- Área -->
                        <div>
                            <label for="area" class="block text-sm font-medium">Área</label>
                            <select id="area" name="area"
                                x-model="form.area"
                                class="w-full p-2 border rounded focus:ring" required>
                                <option value="" disabled selected>Seleccione un área</option>
                                <option>Administración</option>
                                <option>Financiera</option>
                                <option>Compras</option>
                                <option>Infraestructura</option>
                                <option>Operación</option>
                                <option>Talento Humano</option>
                                <option>Servicios Varios</option>
                            </select>
                        </div>

                        <!-- Botones -->
                        <div class="flex justify-end space-x-2 pt-2">
                            <button type="button" @click="modal = false" class="text-gray-700 hover:bg-gray-200 px-3 py-2 rounded-md">
                                Cancelar
                            </button>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </template>

        <!-- Tabla de empleados -->
        <table class="min-w-full bg-white rounded-lg shadow mt-6 overflow-hidden">
            <thead class="bg-gray-200 text-gray-700 uppercase font-semibold tracking-wider">
                <tr>
                    <th class="p-3 text-left">Nombre</th>
                    <th class="p-3 text-left">Correo</th>
                    <th class="p-3 text-left">Área</th>
                    <th class="p-3 text-left">Fecha Ingreso</th>
                    <th class="p-3 text-left">Estado</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="emp in empleados" :key="emp.id">
                    <tr class="border-t">
                        <td class="p-3" x-text="emp.primer_nombre + ' ' + emp.primer_apellido"></td>
                        <td class="p-3" x-text="emp.correo"></td>
                        <td class="p-3" x-text="emp.area"></td>
                        <td class="p-3" x-text="emp.fecha_ingreso"></td>
                        <td class="p-3 text-green-600" x-text="emp.estado ?? 'Activo'"></td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <script>
        function empleadoApp() {
            return {
                modal: false,
                empleados: [],
                form: {
                    primer_apellido: '',
                    segundo_apellido: '',
                    primer_nombre: '',
                    otros_nombres: '',
                    pais_empleo: '',
                    tipo_identificacion: '',
                    numero_identificacion: '',
                    fecha_ingreso: '',
                    area: ''
                },
                errors: {},
                init() {
                    fetch('/api/empleados')
                        .then(res => res.json())
                        .then(data => this.empleados = data)
                        .catch(e => console.error("Error al cargar empleados", e));
                },
                submitForm() {
                    this.errors = {};
                    fetch('/api/empleados', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(this.form)
                    })
                    .then(async res => {
                        if (!res.ok) {
                            if (res.status === 422) {
                                const errorData = await res.json();
                                this.errors = errorData.errors;
                            } else {
                                throw new Error('Error del servidor');
                            }
                        } else {
                            return res.json();
                        }
                    })
                    .then(data => {
                        if (data) {
                            this.empleados.push(data);
                            this.modal = false;
                            this.resetForm();
                        }
                    })
                    .catch(e => console.error("Error al registrar", e));
                },
                resetForm() {
                    this.form = {
                        primer_apellido: '',
                        segundo_apellido: '',
                        primer_nombre: '',
                        otros_nombres: '',
                        pais_empleo: '',
                        tipo_identificacion: '',
                        numero_identificacion: '',
                        fecha_ingreso: '',
                        area: ''
                    };
                    this.errors = {};
                }
            };
        }
    </script>
</body>
</html>

