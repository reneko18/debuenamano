export default function useProduct(){
    const add = async(productId) => {
        let response = await axios.post('/api/cart', {
            productId: productId,
        });
        console.log(response);
    }
    /*const getCount = async() => {
        await axios.get('/sanctum/csrf-cookie');
        let response = await axios.get('/api/cart/count');
    }*/
    const getCount = async () => {
        try {
          const response = await axios.get('/api/cart/count');
          console.log("Count:", response.data.count);
        } catch (error) {
          console.error('Error getting cart count:', error);
          // Handle errors as needed
        }
    }
    

    return {
        add,
        getCount
    }
}