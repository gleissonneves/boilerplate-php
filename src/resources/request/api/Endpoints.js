import ApiRouter from './lib/api';

const Endpoint = {
  auth: {
    login: new ApiRouter({
      baseURL: '',
      routerOrigin: 'v1/auth/login',
      activedMock: false,
      baseMockURL: '',
      routerOriginMock: 'login',
    }),
  },
};

export default Endpoint;
