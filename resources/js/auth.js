import { setAuthorization } from "./general";

export function registerUser(credentials){
  return new Promise((res,rej)=>{
      axios.post('/api/auth/register', credentials)
      .then(response => {
          res(response.data);
      })
      .catch(err => {
          rej('An error occured.. try again later.')
      })
  })
}

export function login(credentials){
  return new Promise((res,rej)=>{
      axios.post('/api/auth/login', credentials)
      .then(response => {
            // setAuthorization(response.data.access_token);
            res(response.data);
      })
      .catch(err => {
          rej('Wrong Email/Password combination.')
      })
  })
}

// export function updateUser(credentials){
//   return new Promise((res,rej)=>{
//       axios.put('/api/auth/update-profile', credentials)
//       .then(response => {
//             res(response.data);
//       })
//       .catch(err => {
//           rej('Wrong')
//       })
//   })
// }

// export function updateUser(){
//   return new Promise((res,rej)=>{
//     const token = localStorage.getItem('token')
//     axios.put('/api/auth/update-profile', 
//       {
//         headers: 
//         {
//           Authorization: `Bearer ${token}`
//         }
//       })
//       .then(response => {
//         res(response.data);
//       })
//     })
// }


export function getLoggedinUser(){
  const userStr = localStorage.getItem('user');

  if(!userStr){
      return null
  }

  return JSON.parse(userStr);
}