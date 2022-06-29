<div class="space-y-4">
    <x-card.card class="divide-y divide-gray-200">
        <x-card.header>
            <x-breadcumb.simple>
                <x-breadcumb.item no-parent link="{{ route('dashboard.index') }}"><x-icon.home class="text-gray-400 hover:text-gray-500" size="5" solid /></x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}">{{__('Administración')}}</x-breadcumb.item>
                <x-breadcumb.item link="{{ route('administration.index') }}?showSubmenu=Companies">{{__('Compañías aseguradoras')}}</x-breadcumb.item>
                <x-breadcumb.item>{{ $company->name }}</x-breadcumb.item>
            </x-breadcumb.simple>
        </x-card.header>
    </x-card.card>


    <x-card.card>
        <x-card.header class="border-b border-gray-200">
            <h3>
                {{__('Datos de la compañía')}}
            </h3>
        </x-card.header>
        <form wire:submit.prevent="saveCompany">
            <x-card.body>
                @include('partials.insurance.company.form-inputs')
                @include('partials.forms.address', ['model' => 'billingAddress', 'readonly' => false])

            </x-card.body>
            @can('insurance.update')
                <x-card.footer class="flex justify-end border-t border-gray-200">
                    <x-button.primary type="submit">{{__('Save')}}</x-button.primary>
                </x-card.footer>
            @endcan
        </form>
    </x-card.card>
</div>
