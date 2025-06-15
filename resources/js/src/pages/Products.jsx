import { useEffect, useState } from 'react';
import api from '../services/api';
import { Link } from 'react-router-dom';

export default function Products() {
    const [products, setProducts] = useState([]);
    const [cart, setCart] = useState([]);
    const [search, setSearch] = useState('');
    const [priceRange, setPriceRange] = useState({ min: '', max: '' });
    const [pagination, setPagination] = useState({
        current_page: 1,
        last_page: 1,
        total: 0,
    });    
    const [currentPage, setCurrentPage] = useState(1);
    // const [loading, setLoading] = useState(true);

    const fetchProducts = async (page = 1) => {
        // setLoading(true);

        try {
            const params = {
                name: search,
                min_price: priceRange.min,
                max_price: priceRange.max,
                page,
            };
            const response = await api.get('/products', { params });
            setProducts(response.data.data);
            setPagination({
                current_page: response.data.current_page,
                last_page: response.data.last_page,
                total: response.data.total,
            });
            setCurrentPage(page);
        } catch (error) {
            console.error('Failed to fetch products:', error);
        } finally {
            // setLoading(false);
        }
    };

    useEffect(() => {
        fetchProducts(1);
    }, []);

    const handleAddToCart = (product, quantity) => {
        setCart(prev => {
        const existing = prev.find(item => item.product_id === product.id);
        if (existing) {
            return prev.map(item =>
            item.product_id === product.id
                ? { ...item, quantity: item.quantity + quantity }
                : item
            );
        }
        return [...prev, { product_id: product.id, quantity }];
        });
    };

   return (
  <div className="container py-5">
    {/* Page Title */}
    <div className="mb-4">
      <h1 className="h3 fw-bold">Products</h1>
      <p className="text-muted">Showing {products.length} of {pagination.total} Products</p>
    </div>

    {/* Filters */}
    <div className="row mb-4">
      <div className="col-md-3 mb-2">
        <input
          type="text"
          className="form-control"
          placeholder="Search by name"
          value={search}
          onChange={e => setSearch(e.target.value)}
        />
      </div>
      <div className="col-md-3 mb-2">
        <input
          type="number"
          className="form-control"
          placeholder="Min price"
          value={priceRange.min}
          onChange={e => setPriceRange({ ...priceRange, min: e.target.value })}
        />
      </div>
      <div className="col-md-3 mb-2">
        <input
          type="number"
          className="form-control"
          placeholder="Max price"
          value={priceRange.max}
          onChange={e => setPriceRange({ ...priceRange, max: e.target.value })}
        />
      </div>
      <div className="col-md-3 mb-2">
        <button className="btn btn-primary w-100" onClick={() => fetchProducts(1)}>
          Apply
        </button>
      </div>
    </div>

    <div className="row">
        <div className="col-lg-8">
             {/* Product Grid */}
            <div className="row">
            {products.map(product => (
                <div key={product.id} className="col-md-4 col-lg-4 mb-4">
                <div className="card h-100 shadow-sm">
                    <img
                    src={`https://images.unsplash.com/photo-1628519592419-bf288f08cef5?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8c3BvcnRzJTIwY2FyfGVufDB8fDB8fHww`}
                    className="card-img-top"
                    alt={product.name}
                    />
                    <div className="card-body d-flex flex-column">
                    <h5 className="card-title">{product.name}</h5>
                    <p className="card-text text-muted">EGP {product.price}</p>
                    <div className="d-flex mb-2">
                        <input
                        type="number"
                        min="1"
                        defaultValue={1}
                        className="form-control me-2"
                        style={{ width: '70px' }}
                        onChange={e => (product.quantity = parseInt(e.target.value))}
                        />
                        <button
                        className="btn btn-success"
                        onClick={() => handleAddToCart(product, product.quantity || 1)}
                        >
                        Add
                        </button>
                    </div>
                    </div>
                </div>
                </div>
            ))}
            </div>

            {/* Pagination */}
            <div className="d-flex justify-content-center align-items-center my-4">
            <button
                className="btn btn-outline-secondary me-2"
                onClick={() => fetchProducts(currentPage - 1)}
                disabled={pagination.current_page === 1}
            >
                Previous
            </button>
            <span>
                Page {pagination.current_page} of {pagination.last_page}
            </span>
            <button
                className="btn btn-outline-secondary ms-2"
                onClick={() => fetchProducts(currentPage + 1)}
                disabled={pagination.current_page === pagination.last_page}
            >
                Next
            </button>
            </div>
        </div>
        <div className="col-lg-4">
             {/* Cart Summary */}
            <div className="mt-5">
            <h4 className="fw-bold mb-3">Order Summary</h4>
            {cart.map(item => {
                const product = products.find(p => p.id === item.product_id);
                return (
                <div key={item.product_id} className="d-flex justify-content-between mb-2">
                    <span>{product?.name}</span>
                    <span>Qty: {item.quantity}</span>
                </div>
                );
            })}

            {cart.length > 0 && (
                <button
                className="btn btn-primary mt-3"
                onClick={async () => {
                    try {
                    const response = await api.post('/orders', {
                        items: cart.map(item => ({
                        product_id: item.product_id,
                        quantity: item.quantity,
                        })),
                    });
                    alert('Order placed successfully!');
                    setCart([]);
                    } catch (err) {
                    console.error(err);
                    alert('Order failed. Please try again.');
                    }
                }}
                >
                Checkout
                </button>
            )}
            </div>
        </div>
    </div>

    {/* Orders Link */}
    <div className="mt-4">
      <Link to="/orders" className="btn btn-outline-primary">
        View My Orders
      </Link>
    </div>
  </div>
);

}
