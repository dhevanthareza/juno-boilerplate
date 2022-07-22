const httpClient = axios.create({
    timeout: 10000,
    headers: {
        'X-CSRF-TOKEN': "{!! csrf_token() !!}"
    }
});