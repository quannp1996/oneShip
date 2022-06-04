const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/admin/Product/app.js', 'public/admin/GroupJS/product/product-edit.js');
mix.js('resources/js/admin/Tag/app.js', 'public/admin/GroupJS/tag/tag-list.js');
mix.js('resources/js/admin/Collection/app.js', 'public/admin/GroupJS/collection/collection.js');
mix.js('resources/js/admin/Warehouse/app.js', 'public/admin/GroupJS/warehouse/warehouse.js');
mix.js('resources/js/admin/WarehouseOrder/app.js', 'public/admin/GroupJS/warehouse/warehouseOrder.js');
mix.js('resources/js/admin/Manufacturer/app.js', 'public/admin/GroupJS/manufacturer/manufacturer.js');
mix.js('resources/js/admin/Specialoffer/app.js', 'public/admin/GroupJS/specialoffer/specialoffer.js');
mix.js('resources/js/admin/PromotionCampaign/app.js', 'public/admin/GroupJS/promotionCampaign/promotionCampaign.js');
if (1 == 0) {
  mix.webpackConfig({
    devtool: 'inline-source-map',
    output: {
      // library: 'libraryName',
      // libraryTarget: 'umd',
      // umdNamedDefine: false,

      chunkFilename: 'public/admin/dashboard/dashboard-app.js',
    }
  }).options({
    hmrOptions: {
      host: 'admin.wsrd.todo.vn'
    }
  });

  mix.styles([
    'public/admin/css/jquery-ui.min.css',
    'public/admin/css/style.css',
    // Media
    'public/admin/css/font-awesome.min.css',
    'public/admin/css/jquery.datetimepicker.min.css',
    'public/admin/css/nprogress.css',
    // CSS
    'public/admin/css/select2.min.css',
    'public/admin/css/customize.css'
  ], 'public/admin/css/all.css').scripts([
    'public/admin/js/library/jquery-3.5.1.min.js',
    'public/admin/vendors/@coreui/coreui/js/coreui.bundle.min.js',
    'public/admin/vendors/@coreui/coreui/js/coreui.bundle.min.map',
    'public/admin/js/library/jquery-ui.min.js',
    'public/admin/js/library/jquery.datetimepicker.min.js',
    'public/admin/js/library/select2.min.js',
    'public/admin/js/library/sweetalert2@10.js',
    'public/admin/js/library/nprogress.min.js',
    'public/admin/js/library/jquery.i18n.min.js',
    'public/admin/js/library/jquery.i18n.messagestore.min.js',
    'public/js/core.js',
    'public/admin/js/tooltips.js',
    'public/admin/js/helpers.js',
    'public/admin/js/admin.js',
    'public/admin/js/lang.js',

    // Setup
    'public/admin/js/init/ajax-setup.js',
    'public/admin/js/init/sidebar-setup.js',
    'public/admin/js/init/plugin-setup.js',
    'public/admin/js/init/submit-setup.js',

    // Customize, hàm dùng chung
    'public/admin/js/customize.js',

    // Customer
    'public/admin/js/customer.js',
    'public/admin/js/customer-group.js',
    // 'public/admin/js/gallery.js',
    'public/admin/js/order.js',
    'public/admin/js/comment.js',
    'public/admin/js/discount.js',
    'public/admin/js/discount-list.js',
    'public/admin/js/iframe.js',
  ], 'public/admin/js/app.js')
    // .sourceMaps(false, 'source-map')
    .version()

  mix.js('resources/js/admin/DashBoard/app.js', 'public/admin/dashboard/dashboard-app.js')
  //  .sass('resources/sass/app.scss', 'public/admin/dashboard/dashboard-app.css');

}
