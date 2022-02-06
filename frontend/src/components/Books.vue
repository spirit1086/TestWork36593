<template>
 <div>
   <div class="m-xs">
     <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#bookModal" v-on:click="statusOperation('create')">Создать</button>
   </div>
   <div class="list-group" v-if="books">
     <div v-for="(book,index) in books.data" :key="index" class="list-group-item list-group-item-action flex-column align-items-start">
       <div class="d-flex w-100 justify-content-between">
         <h5 class="mb-1">{{book.title}} <small>{{book.published}}</small></h5>
         <div class="options">
           <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#bookModal"
                   v-on:click="statusOperation('edit',index,book.id)">Редактировать</button>
           <button type="button" class="btn btn-outline-danger ml" v-on:click="deleteBook(book.id,index)">Удалить</button>
         </div>
       </div>
       <div class="mb-1">
         <p class="author">{{book.author}}</p>
         <p class="category">{{book.book_category}}</p>
         <p class="price">{{book.price}}</p>
       </div>
     </div>
   </div>
   <ModalWindow :modalId="modalId"/>
 </div>
</template>

<script>
import {actionTypes} from '@/store/modules/books';
import {mapState} from 'vuex'
import ModalWindow from "@/components/ModalWindow";

export default {
  name: "Books",
  data(){
    return {
      modalId: 'bookModal',
      book_index:null,
      book_id:null
    }
  },
  components:{
    ModalWindow
  },
  computed: {
    ...mapState({
      isLoading: state => state.Books.isLoading,
      books: state => state.Books.data,
      errors: state => state.Books.errors,
      isEmptyData: state => state.Books.isEmptyData,
      modalParams: state => state.Books.modalParams,
      crudStatus: state => state.Books.crudStatus,
      item: state => state.Books.item
    }),
  },
  methods:{
    clearModal:function (){
      this.$store.state.Books.item = {
       title:null,
       author:null,
       book_category:null,
       published:null,
       price:null,
       id:null
      }
    },
    getBooks:function (){
      this.$store.dispatch(actionTypes.getBooks,{per_page:15})
    },
    getBook:function (id){
      this.$store.dispatch(actionTypes.getBook,id)
    },
    createBook:function (model){
      this.$store.dispatch(actionTypes.createBook, model).then(book=>{
        this.books.data.unshift(book.data)
      })
    },
    editBook:function (model){
      this.$store.dispatch(actionTypes.updateBook, model)
      let books = this.books.data
      this.books.data = null
      books[this.book_index] = model
      this.books.data = books
    },
    deleteBook:function (id,index){
      this.$store.dispatch(actionTypes.deleteBook,id)
      let books = this.books.data
      this.books.data = null
      books.splice(index,1)
      this.books.data = books
    },
    statusOperation:function (value,index=null,id=null){
      this.clearModal()
      this.$store.state.Books.crudStatus = value
      this.book_index = index
      this.book_id = id
      if(id){
        this.getBook(id)
      }
    }
  },
  mounted() {
    this.getBooks()
  },
  watch:{
    modalParams(){
       if(this.crudStatus=='create'){
         this.createBook(this.modalParams)
       }
       else if(this.crudStatus=='edit') {
         this.editBook(this.modalParams)
       }
    }
  }
}
</script>

<style>
 .m-xs{
   margin: 10px;
 }

 .ml{
   margin-left: 5px;
 }
</style>