<template>
    <table class="table align-items-center mb-0">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Author</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Function</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th>
                <th class="text-secondary opacity-7"></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="data in datas" :key="data.id">
                <td>
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ data.nama }}</h6>
                            <p class="text-xs text-secondary mb-0">{{ data.email }}</p>
                        </div>
                    </div>
                </td>
                <td>
                    <p class="text-xs font-weight-bold mb-0">{{ data.jabatan }}</p>
                    <p class="text-xs text-secondary mb-0">{{ data.bagian }}</p>
                </td>
                <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm bg-gradient-success">{{ data.status }}</span>
                </td>
                <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ data.tanggal }}</span>
                </td>
                <td class="align-middle">
                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Edit
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: ['csrf', 'url', 'method'],
    data() {
        return {
            datas: [],
        }
    },
    mounted() {
        fetchData(this);
    }
}

async function fetchData(param) {
    let response = await fetch(param.url, {
        method: param.method,
        headers: {
            'X-CSRF-TOKEN': param.csrf
        }
    });
    if (response.ok) { // if HTTP-status is 200-299
        param.datas = await response.json();
    } else {
        alert("HTTP-Error: " + response.status);
    }
}
</script>