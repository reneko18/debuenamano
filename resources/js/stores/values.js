import { defineStore } from 'pinia';

export const useFormStore = defineStore('form', {
    state: () => ({
        formData: {
          name: '',
          brand: '',
          test: '',
        },
    }),
    actions: {
      setFormData(formData) {
        this.formData = { ...this.formData, ...formData };
      },
      resetForm() {
        this.formData = {
          name: '',
          brand: '',
          test: '',
        };
      },
    }
});