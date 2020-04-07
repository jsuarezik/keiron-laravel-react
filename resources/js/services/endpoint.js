const instance = window.axios.create( {
    baseUrl : '/api',
    withCredentials : false,
    haeders : {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    }
})

export default  {
    get : (uri, data) => {
        return instance.get(uri, { params : data })
    },
    post :  (uri, data, headers) => { //In case of multipart-data 
        return instance.post(uri, data)
    },
    put : (uri, data) => {
        return instance.put(uri, data)
    },
    delete : (uri) => {
        return instance.delete(uri)
    }
}