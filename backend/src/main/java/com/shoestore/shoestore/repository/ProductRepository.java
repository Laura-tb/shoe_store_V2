package com.shoestore.shoestore.repository;

import com.shoestore.shoestore.entity.Product;
import org.springframework.data.jpa.repository.JpaRepository;

public interface ProductRepository extends JpaRepository<Product, Integer> {
}