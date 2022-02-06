import axios from "@/api/axios";

const getBooks = per_page =>{
    return axios.get('/books',{params:{per_page:per_page}})
}

const getBook = id =>{
    return axios.get('/book/'+id)
}

const createBook = data =>{
    return axios.post('/book/create',data)
}

const updateBook = data =>{
    return axios.patch('/book/update/'+data.id,data)
}

const deleteBook = id =>{
    return axios.delete('/book/delete/'+id)
}

export default {
    getBooks,
    getBook,
    createBook,
    updateBook,
    deleteBook
}