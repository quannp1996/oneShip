if ($('#commentCreateApp').length) {
  Vue.config.devtools = true;
  const vm = new Vue({
    el: '#commentCreateApp',
    data: {
      loading: false,
      lang: {},
      discount: {
        code: '',
         // Loại giảm giá: percent: % giảm giá
         //                amount: Số tiền giảm giá
         //                freeship: Miễn phí ship
         discount_type: 'percent',

        discount_value: '',

        object_use: '*', // Đối tượng <người> sử dụng: *:Bất kỳ ai | groups: Nhóm KH | personal: KH cụ thể

        // Đối tượng sản phẩm được áp dụng mã,
          //  *: Tất cả sản phẩm
          //  collection: Bộ sưu tập sản phẩm
          //  single_product: Chỉ ra Sản phẩm cụ thể
        product_use: '*',

        extra_rule: 'none', // Điều kiện phụ
        extra_rule_value: '',
        quanhuyen: '*', // Quận huyện: *: Tất cả quận huyện| single_quanhuyen: Quận huyện cụ thể

        hasShipRate: false, // giới hạn tối đa có thể hỗ trợ freeship,
        quantity: 0,
        is_use_once: 'no',
        start_date: '',
        end_date: '',
      },
      description: {},
      lists: {
        customerGroups: {
          data: [],
          keyword: '',
          choice: [],
          countLoad: 0,
        },

        customers: {
          data: [],
          filter: {
            page: 1,
            keyword: '',
            search: '',
            limit: 10,
          },
          choice: [],
          countLoad: 0,
        },

        provinces: {
          id: [],
          data: [],
          choice: [],
          keyword: '',
          countLoad: 0,
        },

        districts: {
          data: [],
          choice: [],
          keyword: '',
        },

        productCollections: {
          data: [],
          choice: [],
          filter: {
            page: 1,
            keyword: '',
            search: '',
            limit: 10,
          },
          countLoad: 0,
        },

        products: {
          data: [],
          choice: [],
          filter: {
            page: 1,
            keyword: '',
            search: '',
            limit: 10,
          },
          countLoad: 0,
        },
      },

      currentRequest: null,

      showTimePanel: false,
      showTimeRangePanel: false,
    },
    mounted() {
      try {
        let discountCode = $('#discountCodeEdit').val();
            discountCode = JSON.parse(discountCode);
            this.discount = discountCode;
            if (discountCode.districts) {
              this.lists.districts.choice = discountCode.districts;
            }

            if (discountCode.products) {
              this.lists.products.choice = discountCode.products;
            }

            if (discountCode.productCollections) {
              this.lists.productCollections.choice = discountCode.product_collections;
            }

            if (discountCode.customers) {
              this.lists.customers.choice = discountCode.customers;
            }

            if (discountCode.customer_groups) {
              this.lists.customerGroups.choice = discountCode.customer_groups;
              console.log('abc1234');
            }
      } catch (err) {
        console.log(err);
      }
      this.getAllLangData();
    },

    methods: {
      toggleTimePanel() {
        this.showTimePanel = !this.showTimePanel;
      },
      toggleTimeRangePanel() {
        this.showTimeRangePanel = !this.showTimeRangePanel;
      },
      handleOpenChange() {
        this.showTimePanel = false;
      },
      handleRangeClose() {
        this.showTimeRangePanel = false;
      },

      generateDiscountCode(codeLength=6) {
        const discountCode = Math.random().toString(36).substring(2, codeLength+2).toUpperCase();
        this.discount.code = discountCode;
      },
      handleClick(tab, event) {
        console.log(tab, event);
      },
  /* ============================= CUSTOMER GROUPS ======================================*/
      showModalCustomerGroup(ele) {
        const vm = this;
        ++this.lists.customerGroups.countLoad;
        if (this.lists.customerGroups.countLoad == 1) {
          return $.get('/customers-groups').then((res) => this.handleCustomerGroup(res))
                                        .then( () => {
                                          $(ele).modal('show');
                                        });
        } else {
          $(ele).modal('show');
        }
      },

      handleCustomerGroup(res) {
        this.lists.customerGroups.data = res.data;
      },

      saveCustomerGroupToInput(modalEle) {
        return $(modalEle).modal('hide');
      },

      removeCustomerGroup(index) {
        this.lists.customerGroups.choice.splice(index, 1);
      },

/* ============================= DESCRIPTION  ======================================*/

      async getAllLangData() {
        const discountCodeId = this.discount.id;
        return $.ajax({
          type: 'GET',
          url: '/admin/ajax/products/controller/lang',
        }).then((res) => {
            this.lang = res.data;
            if (typeof discountCodeId !== 'undefined') {
              this.getDescriptionData(res.data);
            } else {
              Object.values(res.data).forEach((val) => {
                this.description[val.language_id] = {
                  name: '',
                  language_id: val.language_id,
                  short_description: '',
                  description: '',
                  image: '',
                  discount_code_id: '',
                  short_code_lang: val.short_code,
                  name_lang: val.name,
                  image_lang: val.image,
                };
              });
            }
        });
      },
      async getDescriptionData(dataLang) {
        const discountCodeId = this.discount.id;
        return $.ajax({
          type: 'GET',
          url: `/discount/code/ajaxDescription/${discountCodeId}`,
        }).then((res) => {
          Object.keys(res.data).forEach((key)=> {
            if (typeof dataLang !== 'undefined') {
              this.description[res.data[key].language_id] = {
                name: res.data[key].name,
                language_id: res.data[key].language_id,
                short_description: res.data[key].short_description,
                description: res.data[key].description,
                image: res.data[key].image,
                discount_code_id: res.data[key].discount_code_id,
                short_code_lang: dataLang[key].short_code,
                name_lang: dataLang[key].name,
                image_lang: dataLang[key].image,
              };
            }
          });
          this.description = Object.assign({}, this.description, this.description);
        });
      },
      getClass(idLang) {
        if (idLang === 1) {
          return 'tab-pane active';
        } else {
          return 'tab-pane';
        }
      },
/* ============================= CUSTOMERS  ======================================*/
      showModalKhachHang(modalEle=null) {
        try {
          if (this.currentRequest) {
            clearTimeout(this.currentRequest);
          }

          this.currentRequest = setTimeout(() => {
            this.executeShowKhachHang(modalEle);
          }, 500);
        } catch (err) {
          console.log(err);
        }
      },

      executeShowKhachHang(modalEle) {
        return $.ajax({
          type: 'GET',
          url: '/customers',
          data: this.lists.customers.filter,
        }).then((res) => this.handleCustomers(res))
          .then( () => {
            if (modalEle) {
              $(modalEle).modal('show');
            }
        });
      },

      handleCustomers(res) {
        this.lists.customers.data = res.data;
      },

      changeFilterWithPagi(page) {
        this.lists.customers.countLoad = 0;
        this.lists.customers.filter.page = page;
        return this.showModalKhachHang();
      },

      saveCustomerToInput(modalEle) {
        $('#customers_ids').val(this.lists.customers.choice);
        return $(modalEle).modal('hide');
      },

      removeCustomer(customerId) {
        // const customerItemPosition = this.lists.customers.choice.indexOf({ id: customerId });
        const customerItemPosition = this.lists.customers.choice.map(function(e) {
            return e.id;
        }).indexOf(customerId);
        if (customerItemPosition > -1) {
          this.lists.customers.choice.splice(customerItemPosition, 1);
        }
      },

/* ============================= PROVINCES AND DISTRICT  ======================================*/
      showModalQuanHuyen(modalEle) {
        if (this.lists.provinces.countLoad == 0) {
          if (this.currentRequest) {
            clearTimeout(this.currentRequest);
          }

          this.currentRequest = setTimeout(() => {
            $.get('/provinces').then( (res) => {
              this.lists.provinces.data = res.data;
            }).then( () => {
              $(modalEle).modal('show');
            }).then( () => {
              ++this.lists.provinces.countLoad;
            });
          }, 400);
        } else {
          $(modalEle).modal('show');
        }
      },

      getDistrictByProvinceIds() {
        $.get('/districts', {
          search: 'Province_ID:'+this.lists.provinces.choice,
        }).then((res) => {
          this.lists.districts.data = res.data;
        });
      },

      removeDistrictChosen(district, index) {
        this.lists.districts.choice.splice(index, 1);
      },
/* ============================= PRODUCT'S COLLECTION  ======================================*/

      showModalProductCollection(modalEle) {
        if (this.currentRequest) {
          clearTimeout(this.currentRequest);
        }

        this.currentRequest = setTimeout(() => {
          $.get('/products/collection', this.lists.productCollections.filter).then( (res) => {
            this.lists.productCollections.data = res.data;
          }).then( () => {
            $(modalEle).modal('show');
          }).then( () => {
            ++this.lists.productCollections.countLoad;
          });
        }, 300);
      },

      changeFilterWithPagiProductCollection(page) {
        this.lists.productCollections.countLoad = 0;
        this.lists.productCollections.filter.page = page;
        return this.showModalProductCollection();
      },

      removeCollection(collectionIndex) {
        this.lists.productCollections.choice.splice(collectionIndex, 1);
      },

/* ============================= PRODUCTS  ======================================*/
      showModalProduct(modalEle) {
        if (this.currentRequest) {
          clearTimeout(this.currentRequest);
        }

        this.currentRequest = setTimeout(() => {
          $.get('/products/filter', {
            search: `name:${this.lists.products.filter.keyword}`,
          }).then( (res) => {
            this.lists.products.data = res.data;
          }).then( () => {
            $(modalEle).modal('show');
          }).then( () => {
            ++this.lists.products.countLoad;
          });
        }, 300);
      },

      changeFilterWithPagiProduct(page) {
        this.lists.products.countLoad = 0;
        this.lists.products.filter.page = page;
        return this.showModalProduct();
      },

      removeProduct(productIndex) {
        this.lists.products.choice.splice(productIndex, 1);
      },

      saveDiscountCode(endpoint='/discount/code/store') {
        const metaPayload = {};

        metaPayload.districtIds = this.lists.districts.choice.map((item) => {
          return item.id;
        });

        metaPayload.customerGroupsIds = this.lists.customerGroups.choice.map((item) => {
          return item.id;
        });

        metaPayload.customersIds = this.lists.customers.choice.map((item) => {
          return item.id;
        });

        metaPayload.productCollectionsIds = this.lists.productCollections.choice.map((item) => {
          return item.id;
        });

        metaPayload.productsIds = this.lists.products.choice.map((item) => {
          return item.id;
        });

        this.loading = $.post(endpoint, {
          discount: this.discount,
          meta: metaPayload,
          description: this.description,
        }).then((res) => {
          if (res.success) {
            Swal.fire({
              title: $.i18n('success'),
              text: res.message,
              icon: 'success',
              showCloseButton: true,
            });
          } else {
            const errors = Object.values(res.error);
            let errorMsg = '';
            errors.forEach((item) => {
              errorMsg += `<code class="text-danger">${item.toString()}</code> <br>`;
            });

            Swal.fire({
              title: $.i18n('success'),
              html: errorMsg,
              icon: 'error',
              showCloseButton: true,
            });
          }
        }).fail(function(json) {
            let erorrs = json.responseJSON.error;
            let errorMsg = '';
            Object.keys(erorrs).forEach(item => {
                errorMsg += `<code class="text-danger">${erorrs[item][0]}</code> <br>`;
            })
            Swal.fire({
              title: 'Lỗi',
              html: errorMsg,
              icon: 'error',
              showCloseButton: true,
            });
        }).always( () => {
          this.loading = false;
        });
      },
    }, // End methods

    computed: {
      filteredCustomerGroups() {
        return this.lists.customerGroups.data.filter((item) => {
           return item.title.toLowerCase().indexOf(this.lists.customerGroups.keyword.toLowerCase()) > -1;
        });
      },

      filteredProvinces() {
        return this.lists.provinces.data.filter((item) => {
           return to_slug(item.Name_VI).indexOf(to_slug(this.lists.provinces.keyword)) > -1;
        });
      },

      filteredDistricts() {
        return this.lists.districts.data.filter((item) => {
           return to_slug(item.Name_VI).indexOf(to_slug(this.lists.districts.keyword)) > -1;
        });
      },
    },

    watch: {
      // For customers
      'lists.customers.filter.keyword': {
        handler(newValue) {
          const searchQuery = `email:${newValue};fullname:${newValue};phone:${newValue}`;
          this.lists.customers.filter.search = searchQuery;
          this.showModalKhachHang('#modalKhachHang');
        },
        deep: true,
      },

      'lists.customers.choice': {
        handler(newValue) {
          console.log(newValue);
          $('#customers_ids').val(newValue);
        },
        deep: true,
      },

      // For customer groups
      'lists.customerGroups.choice': {
        handler(newValue) {
          console.log(newValue);
          $('#customer_groups_ids').val(newValue);
        },
        deep: true,
      },

      // For quan huyen
      'lists.provinces.choice': {
        handler(newValue) {
          this.lists.districts.keyword = '';
          return this.getDistrictByProvinceIds();
        },
        deep: true,
      },

      // For product collection
      'lists.productCollections.filter.keyword': {
        handler(newValue) {
          const searchQuery = `email:${newValue};fullname:${newValue};phone:${newValue}`;
          this.lists.productCollections.filter.search = searchQuery;
          this.lists.productCollections.filter.page = 1;
          this.showModalProductCollection('#modalProductCollection');
        },
        deep: true,
      },

      // For product
      'lists.products.filter.keyword': {
        handler(newValue) {
          const searchQuery = `email:${newValue};fullname:${newValue};phone:${newValue}`;
          this.lists.products.filter.search = searchQuery;
          this.lists.products.filter.page = 1;
          this.showModalProduct('#modalProducts');
        },
        deep: true,
      },
    },
  });
}
