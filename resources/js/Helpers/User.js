class User {
    login(data) {
        axios.post('api/auth/login', data)
            .then(({ data }) => {
                console.log(data);
            })
            .catch(error => console.log(error.response.data));
    }
}

export default User = new User();