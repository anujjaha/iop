@section('dataTableCss')
    {{ Html::style("theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}
    {{ Html::style("theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}
    {{ Html::style("theme/plugins/datatables-buttons/css/buttons.bootstrap4.min.css") }}
@endsection

@section('dataTableJs')
{{ Html::script("theme/plugins/datatables/jquery.dataTables.min.js") }}
{{ Html::script("theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}
{{ Html::script("theme/plugins/datatables-responsive/js/dataTables.responsive.min.js") }}
{{ Html::script("theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}
{{ Html::script("theme/plugins/datatables-buttons/js/dataTables.buttons.min.js") }}
{{ Html::script("theme/plugins/datatables-buttons/js/buttons.bootstrap4.min.js") }}
{{ Html::script("theme/plugins/datatables-buttons/js/buttons.html5.min.js") }}
{{ Html::script("theme/plugins/datatables-buttons/js/buttons.print.min.js") }}
{{ Html::script("theme/plugins/datatables-buttons/js/buttons.colVis.min.js") }}
@endsection
