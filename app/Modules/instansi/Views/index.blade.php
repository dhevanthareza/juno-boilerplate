@extends('dashboard_layout.index')

@section('content')

<div id="app">

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Authors table</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="p-3">
                        <komponen></komponen>
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Tes V-Model</label>
                            <input class="form-control" type="text" v-model="updateMe">
                        </div>
                        @{{ updateMe }}
                    </div>
                    <div class="table-responsive p-0">
                        <maintable 
                            csrf="{!! csrf_token() !!}" 
                            url="{!! url('instansi/tespost') !!}"
                            method="POST"
                        >
                        </maintable>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
const { createApp } = Vue;

createApp({
    data() {
        return {
            updateMe: 'It Works!',
        }
    },
    components: componentMap(
        './instansi/vue/', 
        [
            'Komponen', 
            'Maintable',
        ]
    ),
})
.mount('#app');
</script>

@endsection