define(["exports", "../Modal.vue", "../ImageModal.vue", "vue-images"], function (_exports, _Modal, _ImageModal, _vueImages) {
  "use strict";

  Object.defineProperty(_exports, "__esModule", {
    value: true
  });
  _exports.default = void 0;
  _Modal = _interopRequireDefault(_Modal);
  _ImageModal = _interopRequireDefault(_ImageModal);
  _vueImages = _interopRequireDefault(_vueImages);

  function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

  var _default = {
    props: {
      backToCategory: {
        type: String,
        required: true
      },
      saveEndpoint: {
        type: String,
        default: null
      },
      deleteEndpoint: {
        type: String,
        default: null
      },
      work: {
        type: Object,
        required: true
      },
      categories: {
        type: Array,
        default: null
      },
      user: {
        type: Object,
        default: null
      },
      apiToken: {
        type: String,
        required: false
      }
    },

    data() {
      return {
        largePhoto: '',
        modalImage: '',
        title: this.work.title,
        category: this.work.category.id,
        price: this.work.price,
        dimensions: this.work.measurements,
        description: this.work.description,
        images: this.work.medias
      };
    },

    created: function () {
      for (var i = 0; i < this.work['medias'].length; i++) {
        if (this.work['medias'][i].primary == 1) {
          this.largePhoto = this.work['medias'][i];
        }
      }
    },
    computed: {
      updateWork: function () {
        return {
          'title': this.title,
          'selectedCategory': this.category,
          'price': this.price,
          'dimensions': this.dimensions,
          'description': this.description
        };
      }
    },
    methods: {
      changeLargePhoto: function (index) {
        this.largePhoto = this.work['medias'][index];
      },

      showModal() {
        $('#test').modal('show');
      },

      update() {
        this.$http.post(this.saveEndpoint, this.updateWork, {
          headers: {
            Authorization: 'Bearer ' + this.apiToken
          }
        }).then(function (response) {
          this.$bus.$emit('saved');
          location.reload();
        }, response => {});
      },

      showImageModal() {
        this.modalImage = this.largePhoto;
        $('#image').modal('show');
        this.hideArrows();
      },

      nextImage: function (index) {
        if (index >= 0 && index <= this.images.length - 1) {
          if (index + 1 > this.images.length - 1) {
            this.modalImage = this.images[0];
          } else {
            this.modalImage = this.images[index + 1];
          }
        }
      },
      previousImage: function (index) {
        if (index >= 0 && index <= this.images.length - 1) {
          if (index - 1 < 0) {
            this.modalImage = this.images[this.images.length - 1];
          } else {
            this.modalImage = this.images[index - 1];
          }
        }
      },

      showArrows() {
        $('#previousArrow').fadeIn();
        $('#nextArrow').fadeIn();
      },

      hideArrows() {
        $('#previousArrow').fadeOut();
        $('#nextArrow').fadeOut();
      },

      deleteModal() {
        $('#delete').modal('show');
      },

      deleteWorkCancel() {
        $('#delete').modal('hide');
      },

      deleteWork() {
        this.$http.delete(this.deleteEndpoint, {
          headers: {
            Authorization: 'Bearer ' + this.apiToken
          }
        }).then(function (response) {
          this.$bus.$emit('deleted');
          window.location.href = '/' + this.work.category.name;
        }, response => {});
      }

    },
    components: {
      'modal': _Modal.default,
      'vue-images': _vueImages.default,
      'image-modal': _ImageModal.default
    }
  };
  _exports.default = _default;
});