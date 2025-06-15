import { useEffect, useState } from 'react';
import api from '../services/api';

export default function Orders() {
  const [orders, setOrders] = useState([]);

  useEffect(() => {
    api.get('/orders').then(res => setOrders(res.data.data));
  }, []);

  return (
    <div className="container py-4">
      <h2 className="mb-4 fw-bold">My Orders</h2>

      {orders.length === 0 && (
        <div className="alert alert-info">You have no orders yet.</div>
      )}

      {orders.map(order => (
        <div key={order.id} className="card mb-4 shadow-sm">
          <div className="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 className="mb-0">Order #{order.id}</h5>
            <span className="badge bg-primary fs-6">EGP {order.total_price}</span>
          </div>

          <div className="card-body">
            <h6 className="mb-3 text-muted">Products:</h6>
            <ul className="list-group list-group-flush">
              {order.products.map(product => (
                <li key={product.id} className="list-group-item d-flex justify-content-between">
                  <span>{product.name}</span>
                  <span className="badge bg-secondary">Qty: {product.pivot.quantity}</span>
                </li>
              ))}
            </ul>
          </div>
        </div>
      ))}
    </div>
  );
}
