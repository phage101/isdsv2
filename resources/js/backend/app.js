import '@coreui/coreui'
import 'datatables.net-bs4'
import 'datatables.net-responsive-bs4'
import 'datatables.net-buttons-bs4'
import 'datatables.net-buttons/js/buttons.html5'
import 'datatables.net-buttons/js/buttons.print'
import 'datatables.net-buttons/js/buttons.colvis'
import JSZip from 'jszip'
import pdfMake from 'pdfmake/build/pdfmake'
import pdfFonts from 'pdfmake/build/vfs_fonts'

window.JSZip = JSZip
pdfMake.vfs = pdfFonts.pdfMake.vfs
