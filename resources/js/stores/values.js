import { defineStore } from 'pinia';

export const useFormStore = defineStore('form', {
    state: () => ({
        formData: {
          stepOneName: '',
          stepOneCategory: '',
          stepOneGenre: '',
          stepOneAgeIni: '',
          stepOneAgeDateIni: '',
          stepOneAgeFin: '',
          stepOneAgeDateFin: '',
          stepOneProductDescription:'',
          stepTwoBrand: '',
          stepTwoModel: '',
          stepThreeHeight: '',
          stepThreeHeightUnit: '',
          stepThreeWidth: '',
          stepThreeWidthUnit: '',
          stepThreeLong: '',
          stepThreeLongUnit: '',
          stepThreeWeight: '',
          stepThreeWeightUnit: '',
          stepFourState: '',
          stepFourUsageTime: '',
          stepFourUsageUnit: '',
          stepFiveDetails: '',
          stepFiveAdvice: '',
          stepSixAddress: '',
          stepSixContact: '',
          stepSixRegion: {
            id: '',
            name:'',
          },
          stepSixCity: {
            id: '',
            name:'',
          },
          stepSevenPrice: '',
          stepEightName: '',
          stepEightBank: '',
          stepEightBankNumber: '',
          stepEightRut: '',
          stepEightBankType: '',
        },
        characterCount: 0,
    }),
    actions: {
      setFormData(formData) {
        this.formData = { ...this.formData, ...formData };
      },
      setCharacterCount(count) {
        this.characterCount = count;
      },
      /*resetForm() {
        this.formData = {
          name: '',
          brand: '',
          test: '',
        };
      },*/
    }
});