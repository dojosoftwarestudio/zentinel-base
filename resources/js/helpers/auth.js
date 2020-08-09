import Axios from "axios"

export function login(credencials){
    return new Promise((res, rej) => {
        Axios.post('/api/auth/login', credencials)
        .then((response) => {
            res(response.data)
        })
        .catch((err) => {
            rej("Wrong email or password")
        })
    })
}

export function getLocalUser(){
    const user = localStorage.getItem("user")
    if(!user){
        return null
    }
    return JSON.parse(user)
}