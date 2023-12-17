<x-app-layout>
    <div name="styles">
        @livewireStyles
    </div>
    <div name="scripts">
        @livewireScripts
    </div>
    @livewire('usuarios.usuarios-listado-tabla', ['withTabs'=>true, 'tabs'=>['Clientes', 'Empresas'], 'columns'=>['Nombre', 'Correo', 'Avatar'], 'title'=>'Listado de Usuarios'])
</x-app-layout>