<?php
include __DIR__ . '/../header.php';
?>

<div id="app" v-cloak>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Cadastrar cidadão</div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <input
                                ref="newCitizenName"
                                v-model="newCitizen.name"
                                type="text"
                                class="form-control"
                                placeholder="Nome do cidadão"
                                aria-label="Citizen name"
                                aria-describedby="button-addon2"
                                :disabled="control.disable"
                            >
                            <button
                                class="btn btn-outline-primary"
                                type="button"
                                @click="saveCitizen()"
                                :disabled="control.disable"
                            >
                                <span v-if="!control.loading.newCitizen">Salvar</span>
                                <span v-else>
                                    <span
                                        class="spinner-border spinner-border-sm"
                                        role="status"
                                        aria-hidden="true"
                                    ></span>
                                    Salvando...
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header">Buscar cidadão</div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <input
                                ref="findCitizen"
                                v-model="findCitizen.nis"
                                type="text"
                                class="form-control"
                                placeholder="Número do NIS"
                                aria-label="Citizen NIS"
                                :disabled="control.disable"
                                maxlength="11"
                            >
                            <button
                                class="btn btn-outline-primary"
                                type="button"
                                @click="findCitizenByNis()"
                                :disabled="control.disable"
                            >
                                <span v-if="!control.loading.findCitizen">Buscar</span>
                                <span v-else>
                                    <span
                                        class="spinner-border spinner-border-sm"
                                        role="status"
                                        aria-hidden="true"
                                    ></span>
                                    Buscando...
                                </span>
                            </button>
                        </div>
                        <div v-if="control.alertFindCitizen" class="alert alert-warning text-center" role="alert">
                            Cidadão não encontrado
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div
        ref="citizenModal"
        class="modal fade"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border border-success">
                <div class="modal-header text-success text-center">
                    <h5 class="modal-title">{{ citizenModal.title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label class="fw-bold text-muted">Nome:</label> {{ citizenModal.citizen.name }}
                    <br>
                    <label class="fw-bold text-muted">Nº NIS:</label> {{ citizenModal.citizen.nis }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="/assets/js/nis/citizens/home.js"></script>
<?php

include __DIR__ . '/../footer.php';
?>
