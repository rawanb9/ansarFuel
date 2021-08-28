window.$ = window.jQuery = require('jquery');
import moment from "moment";

window.moment = moment;

import {createPopper} from "@popperjs/core";

window.Popper = createPopper;
window.createPopper = createPopper;

require('./bootstrap');

require('select2');
const Swal = require('sweetalert2');
window.Swal = Swal;
