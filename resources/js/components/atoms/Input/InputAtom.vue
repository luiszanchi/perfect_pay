<template>
    <input
        :type="type"
        :class="classValue()"
        :placeholder="placeholder"
        :aria-label="placeholder"
        :name="name"
        :value="value"
        :min="min"
        :max="max"
        :maxlength="maxlength"
        :step="step"
        :disabled="disabled"
        @input="$emit('input', $event.target.value)"
    />
        <!-- @input="$emit('input', $event.target.value)" -->
</template>

<script>
export default {
  methods: {
    classValue: function() {
        switch (this.type) {
            case 'radio':
                return 'form-check-input';
            default:
                return 'form-control';
        }
    },
  },
  props: {
    disabled: {
        type: Boolean,
        default: false
    },
    step: {
        type: String,
    },
    maxlength: {
        type: String,
    },
    min: {
        type: Number
    },
    max: {
        type: Number
    },
    value: {
        type: String,
        required: true
    },
    type: {
        type: String,
        default: 'text'
    },
    placeholder: {
        type: String,
        default: ''
    },
    name: {
        type: String,
        default: ''
    }
  },
  data() {
    return {
    }
  }
}
</script>
