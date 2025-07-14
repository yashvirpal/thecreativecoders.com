import React, { useState } from "react";
import axios from "../../axios";

export default function Login() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");

  const login = async () => {
    try {
      const res = await axios.post("/admin/login", { email, password });
      localStorage.setItem("token", res.data.token);
      alert("Logged in!");
    } catch (error) {
      alert("Login failed");
    }
  };

  return (
    <div>
      <h1>Admin Login</h1>
      <input placeholder="Email" onChange={e => setEmail(e.target.value)} />
      <input placeholder="Password" type="password" onChange={e => setPassword(e.target.value)} />
      <button onClick={login}>Login</button>
    </div>
  );
}
