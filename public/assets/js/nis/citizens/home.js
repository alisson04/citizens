new Vue({
    el: '#app',
    data: {
        message: 'Hello Vue!',
        newCitizen: {name: ''},
        findCitizen: {nis: ''},
        control: {
            disable: false,
            loading: {newCitizen: false, findCitizen:false},
            alertFindCitizen: false,
            requestError: ''
        },
        citizenModal: {
            btModal: {},
            title: '',
            citizen: {},
        },
    },
    mounted() {
        this.citizenModal.btModal =  new bootstrap.Modal(this.$refs.citizenModal, {})
    },
    watch: {
        'findCitizen.nis' () {
            this.findCitizen.nis = this.findCitizen.nis.replace(/[^0-9]/g, '');
        }
    },
    methods: {
        saveCitizen() {
            if (!this.newCitizen.name) {
                this.$refs.newCitizenName.focus()
                return
            }

            this.control.disable = true
            this.control.loading.newCitizen = true

            let request = this.makeAjaxRequest('/citizens/save', "name=" + this.newCitizen.name)

            request.done((data) => {
                this.control.disable = false
                this.control.loading.newCitizen = false

                if (data.error) {
                    return this.triggerError()
                }

                this.cleanNewCitizen()
                this.setModalCitizen(data)

                this.citizenModal.title = 'Novo cidadão cadastrado com sucesso!'
                this.citizenModal.btModal.show()
            });
        },
        findCitizenByNis() {
            if (!this.findCitizen.nis) {
                this.$refs.findCitizen.focus()
                return
            }

            this.control.disable = true
            this.control.loading.findCitizen = true

            let request = this.makeAjaxRequest('/citizens/find_by_nis', "nis=" + this.findCitizen.nis)

            request.done((data) => {
                this.control.disable = false
                this.control.loading.findCitizen = false

                if (data.error) {
                    return this.triggerError()
                }

                if (!data.id) {
                    this.control.alertFindCitizen = true
                    return
                }

                this.cleanNewCitizen()
                this.setModalCitizen(data)

                this.citizenModal.title = 'Cidadão encontrado!'
                this.citizenModal.btModal.show()
            });
        },
        cleanNewCitizen() {
            this.newCitizen = {}
        },
        setModalCitizen(citizen) {
            this.citizenModal.citizen = citizen
        },
        triggerError() {
            Swal.fire('Falha ao realizar ação!', '', 'error')
        },
        makeAjaxRequest(url, data) {
            return $.ajax({url: url, type: "POST", data: data, dataType: "json"});
        }
    }
})