import BooksApi from '@/api/book'

export const mutationTypes = {
    getBooksApiStart: '[books] Books started',
    getBooksApiSuccess: '[books] Books success',
    getBooksApiFailed: '[books] Books failed',
    getBookItemApiSuccess: '[book] Book success',
    deleteBookItemApiSuccess: '[book] Book deleted'
}

export const actionTypes = {
    getBooks: '[books] Get Books items',
    getBook: '[books] Get Book item',
    createBook: '[books] Create Book item',
    updateBook: '[books] Update Book item',
    deleteBook: '[books] Delete Book item',
}

const state = {
    data: null,
    item:null,
    isEmptyData: false,
    isLoading: false,
    errors: null,
    modalParams:null,
    crudStatus:null
}


const mutations = {
    [mutationTypes.getBooksApiStart](state){
        state.item = null
        state.isLoading = true
        state.errors = null
        state.isEmptyData = false
    },
    [mutationTypes.getBooksApiSuccess](state,payload){
        state.data = payload
        state.isEmptyData = payload.data.length ? false : true
        state.isLoading = false
        state.errors = null
        state.item = null
    },
    [mutationTypes.getBooksApiFailed](state,payload){
        state.isLoading = false
        state.errors = payload
        state.isEmptyData= false
        state.item = null
    },
    [mutationTypes.getBookItemApiSuccess](state,payload){
        state.item = payload.data
        state.isEmptyData = payload.data.length ? false : true
        state.isLoading = false
        state.errors = null
    },
    [mutationTypes.deleteBookItemApiSuccess](state){
        state.item = null
        state.isEmptyData = false
        state.isLoading = false
        state.errors = null
    }
}

const actions = {
    [actionTypes.getBooks](context,per_page){
        return new Promise(resolve => {
            context.commit(mutationTypes.getBooksApiStart)

            BooksApi.getBooks(per_page).then(response=>
            {
                context.commit(mutationTypes.getBooksApiSuccess,response.data)
                resolve(response.data)
            }).catch(result=>{
                context.commit(mutationTypes.getBooksApiFailed,result)
            })
        })
    },
    [actionTypes.createBook](context,params){
        return new Promise(resolve => {
            context.commit(mutationTypes.getBooksApiStart)
            BooksApi.createBook(params).then(response=>
            {
                context.commit(mutationTypes.getBookItemApiSuccess,response.data)
                resolve(response.data)
            }).catch(result=>{
                context.commit(mutationTypes.getBooksApiFailed,result)
            })
        })
    },
    [actionTypes.updateBook](context,params){
        return new Promise(resolve => {
            context.commit(mutationTypes.getBooksApiStart)
            BooksApi.updateBook(params).then(response=>
            {
                context.commit(mutationTypes.getBookItemApiSuccess,response.data)
                resolve(response.data)
            }).catch(result=>{
                context.commit(mutationTypes.getBooksApiFailed,result)
            })
        })
    },
    [actionTypes.getBook](context,params){
        return new Promise(resolve => {
            context.commit(mutationTypes.getBooksApiStart)
            BooksApi.getBook(params).then(response=>
            {
                context.commit(mutationTypes.getBookItemApiSuccess,response.data)
                resolve(response.data)
            }).catch(result=>{
                context.commit(mutationTypes.getBooksApiFailed,result)
            })
        })
    },
    [actionTypes.deleteBook](context,params){
        return new Promise(resolve => {
            context.commit(mutationTypes.getBooksApiStart)

            BooksApi.deleteBook(params).then(response=>{
                context.commit(mutationTypes.deleteBookItemApiSuccess)
                resolve(response.data)
            }).catch(result=>{
                context.commit(mutationTypes.getBooksApiFailed,result)
            })
        })
    },
}

export default {
    state,
    mutations,
    actions
}