<template>
    <div>
        <heading class="mb-6">Cache Purge</heading>

        <card
            class="flex flex-col items-center justify-center"
            style="min-height: 300px"
        >
            <form method="post" action='/cache-tool/{urls}' class="mx-auto py-2 w-1/2 h-48" @submit="submitUrl" novalidate="true">
                <label for="url" class="header-500 block w-9/12 m-auto text-left my-2 font-bold">Input URLs</label>

                <textarea id="purgeurl" type="textarea" v-model="urls" placeholder="Enter URLs here, use <enter> to delimit urls." class="border border-gray-600 border-solid rounded-sm w-full h-full block m-auto my-5 p-3" style="height:10rem;"></textarea>

                <button type="submit" class="btn btn-default btn-primary block m-auto my-3">Clear Cache</button>
            </form>
            <p v-if="hasResponse" class="mb-6 mt-1"><span class="font-bold text-cyan-100 mt-1 mb-6">RESULTS: </span><span class="text-cyan-100 mt-1 mb-6" v-text="errorMessage"></span></p>
        </card>
    </div>
</template>

<script>
export default {
    data() {
        return {
            errors: [],
            urls: [],
            errorMessage: "",
            hasResponse: false
        }
    },
    methods: {
        submitUrl: function (e) {
            let urlArray = this.urls.split('\n');
            let self = this;
            let request = {
                'urls': urlArray
            };
             Nova.request().post('/nova-vendor/laravel-cloudflare/purge', request)
            .then(resp => {
                if (resp.data) {
                    self.hasResponse = true;
                    self.errorMessage = resp.data;
                }
            });
            e.preventDefault();
        }
    }
}
</script>

<style>
/* Scoped Styles */
</style>