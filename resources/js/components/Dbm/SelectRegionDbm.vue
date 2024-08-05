<template>
    <div class="position-relative" v-click-outside-element="closeDropdownDbmStatic">
      <div class="position-relative div-select-static">
        <input
          type="text"
          class="form-control cat-select"
          :value="selectedNameStatic"
          @click="showAndCloseDropdownDbmStatic"
          readonly
          :placeholder="placeholder"
        />
        <font-awesome-icon
          :icon="['fas', 'chevron-down']"
          @click="showAndCloseDropdownDbmStatic"
        />
      </div>
      <div :id="dropdownId" v-show="dropdownVisibleDbmStatic" class="dropdown-select-static">
        <div v-for="item in items" :key="item.id">
          <div>
            <input
              :id="item.value + '-' + item.id + '-' + uniqueId"
              class="btn-check"
              :value="item.value"
              type="radio"
              :name="'categoria-' + uniqueId"
              v-model="selectedItemStatic"
              @change="emitSelectionStatic"
            />
            <label :for="item.value + '-' + item.id + '-' + uniqueId" class="btn" @click="closeDropdownDbmStatic">
              {{ item.name }}
            </label>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, watch, computed, onMounted } from 'vue';
  import axios from 'axios';
  
  const props = defineProps({
    items: {
      type: Array,
      default: () => [],
    },
    selected: {
      type: String,
      default: '',
    },
    placeholder: {
      type: String,
      default: ''
    }
  });
  
  const emit = defineEmits(['update:selected-static']);
  
  const selectedItemStatic = ref(props.selected);
  const dropdownVisibleDbmStatic = ref(false);
  
  const uniqueId = ref(`dropdown-${Math.random().toString(36).substr(2, 9)}`);
  const dropdownId = computed(() => `dropdown-select-static-${uniqueId.value}`);
  
  const selectedNameStatic = computed(() => {
    const selectedItem = props.items.find(item => item.value === selectedItemStatic.value);
    return selectedItem ? selectedItem.name : '';
  });
  
  const showAndCloseDropdownDbmStatic = () => {
    if (dropdownVisibleDbmStatic.value === false) {
      dropdownVisibleDbmStatic.value = true;
      TweenMax.fromTo(
        `#${dropdownId.value}`,
        0.55,
        {
          autoAlpha: 0,
          y: -10,
        },
        {
          autoAlpha: 1,
          y: 0,
          ease: Power2.easeOut,
        }
      );
    } else {
      dropdownVisibleDbmStatic.value = false;
      TweenMax.to(`#${dropdownId.value}`, 0.2, {
        autoAlpha: 0,
        y: -10,
        ease: Power2.easeOut,
      });
    }
  };
  
  const closeDropdownDbmStatic = () => {
    dropdownVisibleDbmStatic.value = false;
    TweenMax.to(`#${dropdownId.value}`, 0.2, {
      autoAlpha: 0,
      y: -10,
      ease: Power2.easeOut,
    });
  };
  
  const emitSelectionStatic = () => {
    emit('update:selected-static', selectedItemStatic.value);
  };
  
  watch(() => props.selected, (newVal) => {
    selectedItemStatic.value = newVal;
  });
  
  watch(selectedItemStatic, (newVal) => {
    emit('update:selected-static', newVal);
  });
  
  const regions = ref([]);
  
  onMounted(async () => {
    try {
      const response = await axios.get('URL_TO_YOUR_API');
      regions.value = response.data.regions.map(region => ({
        id: region.regionId,
        name: region.regionName,
        value: region.regionId
      }));
    } catch (error) {
      console.error('Error fetching regions:', error);
    }
  });
  </script>
  

  