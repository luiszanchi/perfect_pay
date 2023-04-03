<template>

    <div class="container">
        <div class="row">
            <LabelInputAtom>
                Nome:
            </LabelInputAtom>
            <div class="col-sm-10">
                <InputAtom
                    placeholder="Nome"
                    :value="name"
                    @input="event => name = getString(event)"
                    :disabled="disableAll"
                ></InputAtom>
            </div>
        </div>
        <div class="row">
            <LabelInputAtom>
                Sobrenome:
            </LabelInputAtom>
            <div class="col-sm-10">
                <InputAtom
                    placeholder="Sobrenome"
                    :value="lastName"
                    @input="event => lastName = getString(event)"
                    :disabled="disableAll"
                ></InputAtom>
            </div>
        </div>
        <div class="row">
            <LabelInputAtom>
                CPF:
            </LabelInputAtom>
            <div class="col-sm-10">
                <InputAtom
                    placeholder="CPF"
                    :value="cpf"
                    :max="11"
                    @input="event => cpf = getString(event)"
                    :disabled="disableAll"
                ></InputAtom>
            </div>
        </div>
        <div class="row">
            <LabelInputAtom>
                Email:
            </LabelInputAtom>
            <div class="col-sm-10">
                <InputAtom
                    type="email"
                    placeholder="Email"
                    :value="email"
                    @input="event => email = getString(event)"
                    :disabled="disableAll"
                ></InputAtom>
            </div>
        </div>

        <div class="row">
            <LabelInputAtom>
                Valor:
            </LabelInputAtom>
            <div class="col-sm-10">
                <InputAtom
                    placeholder="Valor"
                    min="1.0"
                    type="number"
                    step="0.01"
                    :value="value"
                    @input="event => value = getString(event)"
                    :disabled="disableAll"
                ></InputAtom>
            </div>
        </div>

        <div class="row">
            <LabelInputAtom>
                Tipo de Pagamento:
            </LabelInputAtom>
            <div class="col-sm-10">
                <input
                    type="radio"
                    value="credit_card"
                    v-model="paymentType"
                    :disabled="disableAll"
                />
                <label>Cartão de Crédito</label>

                <br>

                <input
                    :disabled="disableAll"
                    type="radio"
                    value="billet"
                    v-model="paymentType"
                />
                <label>Boleto</label>
            </div>
        </div>

        <div class="row" v-if="paymentType == 'credit_card'">
            <LabelInputAtom>
                Cartão de Crédito:
            </LabelInputAtom>
            <div class="col-sm-10">
                <InputAtom
                    :disabled="disableAll"
                    placeholder="Cartão de Crédito"
                    :maxlength="16"
                    :value="credit_card"
                    @input="event => credit_card = getString(event)"
                ></InputAtom>
            </div>
        </div>
        <div class="row" v-if="paymentType == 'credit_card'">
            <LabelInputAtom>
                Número de Parcelas:
            </LabelInputAtom>
            <div class="col-sm-10">
                <InputAtom
                    :disabled="disableAll"
                    type="number"
                    :min="1"
                    :max="12"
                    step="1.0"
                    placeholder="Número de Parcelas"
                    :value="installments"
                    @input="event => installments = getString(event)"
                ></InputAtom>
            </div>
        </div>
        <div class="row" v-if="paymentType == 'credit_card'">
            <LabelInputAtom>
                Código de Segurança:
            </LabelInputAtom>
            <div class="col-sm-10">
                <InputAtom
                    :disabled="disableAll"
                    type="number"
                    placeholder="Código de Segurança"
                    :value="credit_card_security_code"
                    @input="event => credit_card_security_code = getString(event)"
                ></InputAtom>
            </div>
        </div>

        <div class="row" v-if="paymentType == 'credit_card'">
            <LabelInputAtom>
                Mês de expiração:
            </LabelInputAtom>
            <div class="col-sm-10">
                <InputAtom
                    :disabled="disableAll"
                    :min="1"
                    :max="12"
                    step="1.0"
                    type="number"
                    placeholder="Mês de expiração"
                    :value="credit_card_month_expiration"
                    @input="event => credit_card_month_expiration = getString(event)"
                ></InputAtom>
            </div>
        </div>


        <div class="row" v-if="paymentType == 'credit_card'">
            <LabelInputAtom>
                Ano de expiração:
            </LabelInputAtom>
            <div class="col-sm-10">
                <InputAtom
                    :disabled="disableAll"
                    :min="2023"
                    :max="2035"
                    step="1.0"
                    type="number"
                    placeholder="Ano de expiração"
                    :value="credit_card_year_expiration"
                    @input="event => credit_card_year_expiration = getString(event)"
                ></InputAtom>
            </div>
        </div>

        <div class="row">
            <button
                type="button"
                class="btn btn-primary"
                @click="finishSale()"
                :disabled="disableAll"
            >
                Finalizar Compra
            </button>
        </div>
    </div>
    <div>

    </div>
</template>

<script>
import InputAtom from '../../atoms/Input/InputAtom.vue';
import LabelInputAtom from '../../atoms/Input/LabelInputAtom.vue';
import SpanInputAtom from '../../atoms/Input/SpanInputAtom.vue';
import SpanInputRadioAtom from '../../atoms/Input/SpanInputRadioAtom.vue';
import InputGroupMolecule from '../../molecules/Input/InputGroupRadioMolecule.vue';
import InputGroupRadioMolecule from '../../molecules/Input/InputGroupRadioMolecule.vue';
import InputStringHelper from '../../../helpers/InputString';
let paymentTypes = ['credit_card', 'billet'];

import axios from 'axios';

export default {
  components: {
    InputAtom: InputAtom,
    LabelInputAtom: LabelInputAtom,
    SpanInputAtom: SpanInputAtom,
    SpanInputRadioAtom: SpanInputRadioAtom,
    InputGroupMolecule: InputGroupMolecule,
    InputGroupRadioMolecule: InputGroupRadioMolecule,
  },
  methods: {
    getString:(val) => InputStringHelper(val),
    finishSale: function() {
        this.disableAll = true;

        axios.post('/api/sale', {
            name: this.name,
            lastName: this.lastName,
            value: this.value,
            email: this.email,
            cpf: this.cpf,
            paymentType: this.paymentType,
            credit_card: this.credit_card,
            installments: this.installments,
            credit_card_security_code: this.credit_card_security_code,
            credit_card_month_expiration: this.credit_card_month_expiration,
            credit_card_year_expiration: this.credit_card_year_expiration,
        })
        .then(function () {
            this.$router.push({name: 'success'})
        })
        .finally(function () {
            this.disableAll = false;
        })
    }
  },
  data() {
    return {
        name: 'Fulano',
        lastName: 'de Tal',
        email: 'fulano@teste.com',
        cpf: '',
        value: 80.50,
        paymentType: paymentTypes[0],
        credit_card: '4444222222222222',
        installments: 1,

        credit_card_security_code: 642,
        credit_card_month_expiration: 12,
        credit_card_year_expiration: 2030,

        disableAll: false
    }
  }
}
</script>
