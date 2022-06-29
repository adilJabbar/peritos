<x-card.body>
    <div class="grid grid-cols-2 gap-4">
        <div class="space-y-4 ">
            <livewire:administration.risk.group-table :country="$country" :key="'riskgroupsfor'.$country->id.'-'.$riskGroup->getKey()" :riskgroupSelected="$riskGroup->getKey()" />
        </div>

        @if($riskGroup->getKey())
            <div class="space-y-4">
                <livewire:administration.risk.subgroup-table :riskgroup="$riskGroup" :key="'risksubgroupsfor'.$riskGroup->id.'-'.$riskSubgroup->getKey()" :risksubgroupSelected="$riskSubgroup->getKey()"/>
            </div>
        @endif

        @if($riskSubgroup->getKey())
            <div class="col-span-2 space-y-4">
                <livewire:administration.risk.detail-table :riskSubgroup="$riskSubgroup" :key="'riskdetailsfor'.$riskSubgroup->id" />
            </div>
        @endif


    </div>



</x-card.body>
