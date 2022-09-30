@extends('dashboard_layout.index')

@section('content')

<div id="app">

    <div class="row">
        <div class="col-8">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Coba Tabel</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <maintable 
                            csrf="{!! csrf_token() !!}" 
                            url="{!! url('karyawan/tespost') !!}"
                            method="POST"
                        >
                        </maintable>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Coba Form</h6>
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
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Coba CKEditor (vanilla, nda reactive)</h6>
                </div>
                <div class="card-body p-3">
                    <form method="POST" action="{!! url('karyawan/tessubmit') !!}" ref="myform">
                        @csrf
                        <datepicker name="tanggal" v-model="tanggal"></datepicker>
                        <editor 
                            identifier="karyawan"
                            name="coba_editor"
                        ></editor>
                        <editor 
                            identifier="karyawan"
                            name="coba_editor2"
                        ></editor>
                        <a class="btn btn-primary" href="#" v-on:click="mySubmit">Tes Submit</a>
                        Cek hasil submit di console.log
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
const { ref, createApp } = Vue;

createApp({
    data() {
        return {
            updateMe: 'It Works!',
            tanggal: ref(),
        }
    },
    methods: {
        mySubmit() {
            // get form data
            form_result = new FormData(this.$refs.myform);

            // update ckeditor
            updateCkeditor(form_result, [
                ['karyawan', 'coba_editor'],
                ['karyawan', 'coba_editor2'],
            ]);

            console.log([...form_result]);
        }
    },
    components: { 
        'Datepicker': VueDatePicker,

        ...componentMap(
            './vue/karyawan/', 
            [
                'Komponen', 
                'Maintable',
                'Editor',
            ]
        )
    },
})
.mount('#app');
</script>

@endsection