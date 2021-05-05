<template>
  <div>
    <div class="table w-full ...">
      <div class="table-row-group">
        <div class="table-row text-2xl">
          <div class="table-cell text-center">Nombre</div>
          <div class="table-cell text-center">Acciones</div>
        </div>
        <div v-for="evento in eventos" :key="evento.id" class="table-row">
          <div class="table-cell pt-5">{{ evento.nombre }}</div>
          <div class="flex justify-center pt-5">
            <div class="flex justify-end" x-data="{show:false}">
              <button
                class="p-2 border border-blue-500"
                x-on:click.prevent="show=!show"
                v-on:click="cargar(evento.id)"
              >
                Reservar
              </button>
              <div
                class="fixed inset-0 z-10 overflow-y-auto"
                aria-labelledby="modal-title"
                role="dialog"
                aria-modal="true"
                x-show="show"
              >
                <div
                  class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0"
                >
                  <div
                    class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"
                    aria-hidden="true"
                  ></div>
                  <span
                    class="hidden sm:inline-block sm:align-middle sm:h-screen"
                    aria-hidden="true"
                    >&#8203;</span
                  >
                  <div
                    class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-xl sm:w-full"
                  >
                    <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                      <div class="sm:flex sm:items-start">
                        <div
                          class="w-full mt-3 text-center sm:mt-0 sm:text-left"
                        >
                          <h3
                            class="pb-2 text-lg font-semibold leading-6 text-center text-gray-900 uppercase border-b-2"
                            id="modal-title"
                          >
                            {{ evento.nombre }}
                          </h3>
                          <div class="mt-2">
                            <select
                              v-model="selected"
                              name=""
                              id=""
                              @change="onChange(evento.id)"
                            >
                              <option value="">Seleccionar Día</option>
                              <option
                                v-for="infoDia in eventoInfo"
                                :key="infoDia.id"
                              >
                                {{ infoDia.dia }}
                              </option>
                            </select>
                            <div class="pt-3">
                              Cupos disponibles:
                              {{ horasReservas.numero_citas }}
                            </div>
                            <div
                              v-for="horaReserva in horasReservas.horas"
                              :key="horaReserva.id"
                            >
                              <div class="pt-3" v-if="horaReserva.disponible">
                                <input
                                  type="radio"
                                  :id="horaReserva.hora"
                                  :value="horaReserva.hora"
                                  v-model="picked"
                                />
                                <label class="ml-2" :for="horaReserva.hora"
                                  >Hora: {{ horaReserva.hora }}:00</label
                                >
                              </div>
                            </div>
                            <span class="pt-2 text-red-400">{{ message }}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse"
                    >
                      <button
                        class="inline-flex items-center px-4 py-2 ml-3 text-sm font-semibold uppercase transition duration-150 ease-in-out border rounded-md focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25"
                        x-on:click.prevent="show=false"
                      >
                        Cancelar
                      </button>
                      <button
                        class="inline-flex items-center px-4 py-2 ml-3 text-sm font-semibold uppercase transition duration-150 ease-in-out border rounded-md focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25"
                        v-on:click="postReserva()"
                      >
                        Reservar
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br />
  </div>
</template>
<script>
const default_layout = "default";

export default {
  computed: {},
  data() {
    return {
      message: "",
      eventos: {},
      eventoInfo: {},
      selected: "",
      idEvento: "",
      horasReservas: "",
      picked: "",
      formData: {},
    };
  },
  methods: {
    getDataEventos: function () {
      const url = "/getDataEventos";
      axios
        .get(url)
        .then(function (response) {
          //console.log(response);
          return response.data;
        })
        .then((response) => {
          this.eventos = response;
          //console.log(this.eventos);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    cargar: function (id) {
      const url = "/getEvento/" + id;
      this.eventoInfo = {};
      this.selected = "";
      this.horasReservas = {};
      axios
        .get(url)
        .then(function (response) {
          //console.log(response);
          return response;
        })
        .then((response) => {
          this.eventoInfo = response.data;
          console.log(response.data);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    onChange: function (id) {
      const url = "/getDayEvent/" + id + "/" + this.selected;
      this.horasReservas = {};
      this.idEvento = id;
      axios
        .get(url)
        .then(function (response) {
          //console.log(response);
          return response;
        })
        .then((response) => {
          this.horasReservas = response.data;
          console.log(response.data);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    postReserva: function (id) {
      const url = "/postReserva";
      this.formData = {};
      this.formData.dia = this.selected;
      this.formData.hora = this.picked;
      this.formData.evento = this.idEvento;
      axios
        .post(url, this.formData)
        .then(function (response) {
          //console.log(response);
          return response;
        })
        .then((response) => {
          this.message = response.data;
          console.log(response.data);
          this.onChange(this.idEvento);
          this.picked = "";
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
  created: function () {
    this.getDataEventos();
  },
};
</script>
