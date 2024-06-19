// Exemplo de uso do localStorageModule
// Definir um item como objeto JSON
// localStorageModule.setItem('userInfo', { username: 'user1', role: 'admin' });
// Definir um item como string direta
// localStorageModule.setItem('token', 'abc123');
// Obter um item que foi definido como objeto JSON
// const userInfo = localStorageModule.getItem('userInfo');
// console.log('userInfo:', userInfo);
// Obter um item que foi definido como string direta
// const token = localStorageModule.getItem('token');
// console.log('token:', token);
// Remover um item
// localStorageModule.removeItem('token');



const localStorageModule = (() => {
  // Função privada para verificar se o localStorage está disponível
  const isLocalStorageAvailable = () => {
    try {
      const testKey = '__test__';
      localStorage.setItem(testKey, testKey);
      localStorage.removeItem(testKey);
      return true;
    } catch (e) {
      return false;
    }
  };


  /**
   * Retrieves an item from the local storage.
   *
   * @param {string} key - The key of the item to retrieve.
   * @return {*} The value associated with the given key, or null if local storage is not available.
   * If the value is a JSON string, it will be parsed and returned as an object. Otherwise, the value will be returned as is.
   */
  const getItem = (key) => {
    if (!isLocalStorageAvailable()) {
      console.error('LocalStorage is not available.');
      return null;
    }
    const item = localStorage.getItem(key);
    try {
      return JSON.parse(item);
    } catch (e) {
      return item; // Se não for JSON, retorna o valor direto
    }
  };


/**
 * Sets an item in the local storage.
 *
 * @param {string} key - The key of the item to be set.
 * @param {*} value - The value of the item to be set. If the value is an object and not an array, it will be stringified before being stored.
 * @return {void} This function does not return anything.
 */
  const setItem = (key, value) => {
    if (!isLocalStorageAvailable()) {
      console.error("LocalStorage is not available.");
      return;
    }
    if (typeof value === "object" && !Array.isArray(value)) {
      localStorage.setItem(key, JSON.stringify(value));
    } else {
      localStorage.setItem(key, value); // Armazena como string direta se não for objeto
    }
  };

  /**
   * Removes an item from the local storage.
   *
   * @param {string} key - The key of the item to be removed.
   * @return {void} This function does not return anything.
   */
  const removeItem = (key) => {
    if (!isLocalStorageAvailable()) {
      console.error('LocalStorage is not available.');
      return;
    }
    localStorage.removeItem(key);
  };

  return {
    getItem,
    setItem,
    removeItem
  };
})();

export default localStorageModule;