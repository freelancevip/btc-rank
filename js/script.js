Vue.config.debug = true;
Vue.config.devtools = true;
var baseUrl = 'http://localhost:2323/';
new Vue({
    el: '#app',
    components: {
        VueBootstrapTable: VueBootstrapTable
    },
    data: {
        logging: [],
        showFilter: true,
        showPicker: false,
        paginated: true,
        perPage: 10,
        multiColumnSortable: false,
        filterCaseSensitive: false,
        columns: [
            {
                title: "#",
                name: "id"
            },
            {
                title: "Название",
                name: "title"
            },
            {
                title: "Капитализация",
                name: "capital",
                renderfunction: function (colname, entry) {
                    return '$' + entry.capital.toLocaleString()
                }
            },
            {
                title: "Курс",
                name: "course",
                renderfunction: function (colname, entry) {
                    return '$' + entry.course.toLocaleString()
                }
            },
            {
                title: "Изменение 24ч",
                name: "diff",
                renderfunction: function (colname, entry) {
                    var className = '';
                    var triangle = '';
                    var value = parseFloat(entry.diff);
                    if (value > 0) {
                        className = 'label label-success';
                        triangle = '▲';
                    } else if (value < 0) {
                        className = 'label label-danger';
                        triangle = '▼';
                    }
                    return '<span class="' + className + '">' + triangle + entry.diff + '</span>'
                }
            }
        ],
        values: []
    },
    created: function () {
        this.getRows();
    },
    methods: {
        getRows: function (resource) {
            var dataUrl = baseUrl + 'app/data.php';
            this.$http.get(dataUrl).then(function (response) {
                this.values = response.data.data;
            });
        }
    }
});
