<template>
<b-card bg-variant="dark" text-variant="white" title="Delivery order"  style="max-width: 20rem;"
    class="mb-2">
  <div>
    <b-form @submit="onSubmit" @reset="onReset" v-if="show">
      <b-form-group
        id="input-group-1"
        label="Your Name"
        label-for="input-1"
      >
        <b-form-input
          id="input-1"
          v-model="form.name"
          type="text"
          placeholder="Enter name"
          required
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-2" label="Your phone:" label-for="input-2">
        <b-form-input
          id="input-2"
          v-model="form.phone"
          placeholder="Enter numbers"
          required
        ></b-form-input>
      </b-form-group>

        <b-form-group id="input-group-2" label="Your adress:" label-for="input-2">
        <b-form-input
          id="input-2"
          v-model="form.adress"
          placeholder="Enter adress"
          required
        ></b-form-input>
        </b-form-group>

    <div>
    <b-form-group label="Tariff types" v-slot="{ ariaDescribedby }">
      <b-form-radio-group
        id="btn-radios-1"
        v-model="selected"
        :options="optionsTariffName"
        :aria-describedby="ariaDescribedby"
        name="radios-btn-default"
        @click="selectTarif"
        buttons
      ></b-form-radio-group>
    </b-form-group>
    </div>
    
      <b-form-group id="input-group-3" label="Delivery day:" label-for="input-3">
        <b-form-select
          id="input-3"
           v-model="form.firstDeliveryDay"
          :options="optionsDeliveryDays"
          required
        ></b-form-select>
        
      </b-form-group>
       <b-alert show variant="success">{{info}}</b-alert>
      

      <b-button type="submit" variant="primary">Submit</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
    </b-form>
    <!-- <b-card class="mt-3" header="Form Data Result">
      <pre class="m-0">{{ form }}</pre>
    </b-card> -->
  </div>
  </b-card>
</template>

<script>
import axios from "axios"

  export default {
    data() {
      return {
          info: '',
          dataTariff : [],
          selected: '',
          optionsTariffName: [],
          optionsDeliveryDays: [],
        form: {
          tariffId:    0,
          name: '',
          phone: '',
          adress: '',
          firstDeliveryDay: '',
        },
        show: true
      }
    },

    mounted() {
    axios
      .get('http://127.0.0.1:8000/api/tariff')
      .then(response => {

          this.dataTariff = response;
          for(var item in this.dataTariff.data)
          {
            this.optionsTariffName.push(this.dataTariff.data[item].name);
          }
        });
    },

    watch: {
      selected: function(val)
      {
        while(this.optionsDeliveryDays.length > 0)
        {
          this.optionsDeliveryDays.pop();
        }


        for(var item in this.dataTariff.data)
        {
          if(this.dataTariff.data[item].name == val)
          {
            let days = this.dataTariff.data[item].delivery_days;
            const DAY_MILSEC = 24 * 60 * 60 * 1000;

            let today = new Date().getTime();


            for(let i = 0; i < days; i++)
            {
                  let date = new Date(today + DAY_MILSEC * i);

                  this.optionsDeliveryDays.push(this.getDay(date));
            }
            this.form.tariffId = this.dataTariff.data[item].id;
          }
        }
      }
    },

    methods: {
      selectTarif(){
        console.log(this.selected);
        console.log('gwege');
      },
      onSubmit(event) {
        event.preventDefault()
        alert(JSON.stringify(this.form))

        axios({
              method: 'post',
              url: 'http://127.0.0.1:8000/api/save_order',
              data: this.form
            }).then(response => (this.info = response.data));
      },
      onReset(event) {
         
        event.preventDefault()
        this.info = '';
        this.form.phone = '';
        this.form.name = '';
        this.form.adress = '';
        this.form.firstDeliveryDay = '';
        this.optionsDeliveryDays = [];
        this.show = false;
        this.$nextTick(() => {
          this.show = true
        })
      },

      getDay(date) {
        let days = ["Вскр", "Пон", "Втр", "Сред", "Чтв", "Пят", "Суб"];
        return date.getDate() + " " + days[date.getDay()];
      },
    }
  }
</script>