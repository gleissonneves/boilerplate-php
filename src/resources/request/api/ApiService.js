import axios from 'axios';
import { useAppState } from '@/App.state.js';
// import ReauthenticationService from '@/shared/Service/reauthentication/reauthentication.js';

export default class ApiService {
  
  constructor(header = {}, config = {}) {
    // this.appState = new ReauthenticationService();
    
    this.axiosInstance = axios.create({
      headers: {
        'Content-Type': 'application/json',
        ...header,
      },
      ...config,
    });

    // Adiciona um interceptor de resposta
    this.axiosInstance.interceptors.response.use(
      (response) => {
        return response;
      },
      (error) => {
        if (error.response.status === 401) {
          if (error.response.data.message === 'O token está expirado.') {
            useAppState().setStateModal(true);
            alert('é necessario reatenticar na aplicação');
          }
        }
        // Trata erros na resposta
        return Promise.reject(error);
      }
    );
  }

  get httpInstace() {
    return this.axiosInstance;
  }

  delete(endpoint, config = {}) {
    return this.httpInstace.delete(endpoint, config);
  }

  get(endpoint, queryParams = {}) {
    return this.httpInstace.get(endpoint, queryParams);
  }

  put(endpoint, body = {}, config = {}) {
    return this.httpInstace.put(endpoint, body, config);
  }

  post(endpoint, body = {}, config = {}) {
    return this.httpInstace.post(endpoint, body, config);
  }
}
