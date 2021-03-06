import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'
import ElementUI from 'element-ui'
import locale from 'element-ui/lib/locale/lang/en'
import Vuelidate from 'vuelidate'
import CKEditor from 'ckeditor4-vue';

Vue.use(Vuelidate)
Vue.use(CKEditor);

// import 'element-ui/lib/theme-chalk/index.css'

import '~/plugins'
import '~/components'
Vue.use(ElementUI, { locale })

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
})
