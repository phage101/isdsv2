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

// FullCalendar
import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import bootstrapPlugin from '@fullcalendar/bootstrap'

// FullCalendar CSS (import via JS to ensure proper resolver handling)
// FullCalendar CSS: daygrid/timegrid/bootstrap provide the needed styles
import '@fullcalendar/daygrid/main.css'
import '@fullcalendar/timegrid/main.css'
import '@fullcalendar/bootstrap/main.css'

// expose to window if other inline scripts expect it
window.FullCalendar = {
	Calendar,
	dayGridPlugin,
	timeGridPlugin,
	interactionPlugin,
	bootstrapPlugin
}
