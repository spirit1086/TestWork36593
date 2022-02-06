<template>
  <div>
    <div class="modal fade" :id="modalId" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalLabel">Добавить книгу</h5>
          </div>

          <div class="modal-body">
              <div class="form-group">
                <label for="title"><b>Наименование</b></label>
                <input type="text" name="title" id="title" v-model="title" class="form-control" required />
              </div>
              <div class="form-group">
                <label for="author"><b>Автор</b></label>
                <input type="text" name="author" id="author" v-model="author" class="form-control" required />
              </div>
              <div class="form-group">
                <label for="published"><b>Дата публикации</b></label>
                <input type="text" name="published" id="published" v-model="published" class="form-control"  required />
              </div>
              <div class="form-group">
                <label for="price"><b>Цена</b></label>
                <input type="text" name="price" id="price" v-model="price" class="form-control"  required/>
              </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">отмена</button>
            <button type="button" class="btn btn-primary"  v-on:click="save">сохранить</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {mapState} from 'vuex'

export default {
  name: "ModalWindow",
  data(){
    return{
       title:null,
       author:null,
       book_category:null,
       published:null,
       price:null,
       id: null
     }
  },
  props:{
    modalId: {
      type: String,
      required: true
    }
  },
  computed: {
    ...mapState({
      crudStatus: state => state.Books.crudStatus,
      item: state => state.Books.item
    }),
  },
  watch: {
    item:function (){
      if(this.item){
        let book = this.item
        this.title = book.title
        this.author = book.author
        this.book_category = book.book_category
        this.published = book.published
        this.price = book.price
        this.id = book.id
      }
    }
  },
  methods:{
    save:function (){
       if(this.title!=null && this.author!=null && this.published!=null && this.price!=null)
       {
         this.$store.state.Books.modalParams={
           title:this.title,
           author:this.author,
           book_category:'paper',
           published:this.published,
           price:this.price,
           id: this.id
         }
         document.getElementById(this.modalId).click();
       }
    }
  }
}
</script>