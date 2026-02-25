package com.shoestore.shoestore.service;

import com.shoestore.shoestore.entity.Product;
import com.shoestore.shoestore.exception.ResourceNotFoundException;
import com.shoestore.shoestore.repository.ProductRepository;
import org.springframework.stereotype.Service;

import java.util.List;

import com.shoestore.shoestore.dto.ProductRequestDto;
import com.shoestore.shoestore.dto.ProductResponseDto;

@Service
public class ProductService {

    private final ProductRepository productRepository;

    public ProductService(ProductRepository productRepository) {
        this.productRepository = productRepository;
    }

    public List<ProductResponseDto> findAllDto() {

        return productRepository.findAll()
                .stream()
                .map(p -> new ProductResponseDto(
                        p.getId(),
                        p.getImage(),
                        p.getName(),
                        p.getPrice(),
                        p.getStock(),
                        p.getCreatedAt()))
                .toList();
    }

    public Product getById(Integer id) {
        return productRepository.findById(id).orElse(null);
    }

    public Product save(Product product) {
        return productRepository.save(product);
    }

    public ProductResponseDto update(Integer id, ProductRequestDto dto) {

        Product product = productRepository.findById(id)
                .orElseThrow(() -> new ResourceNotFoundException("Product not found: " + id));

        product.setImage(dto.getImage());
        product.setName(dto.getName());
        product.setPrice(dto.getPrice());
        product.setStock(dto.getStock());

        Product updated = productRepository.save(product);

        return new ProductResponseDto(
                updated.getId(),
                updated.getImage(),
                updated.getName(),
                updated.getPrice(),
                updated.getStock(),
                updated.getCreatedAt());
    }

    public void delete(Integer id) {
        productRepository.deleteById(id);
    }

    public boolean deleteIfExists(Integer id) {
        if (!productRepository.existsById(id))
            return false;
        productRepository.deleteById(id);
        return true;
    }

    public ProductResponseDto create(ProductRequestDto dto) {

        Product product = new Product();
        product.setImage(dto.getImage());
        product.setName(dto.getName());
        product.setPrice(dto.getPrice());
        product.setStock(dto.getStock());

        Product saved = productRepository.save(product);

        return new ProductResponseDto(
                saved.getId(),
                saved.getImage(),
                saved.getName(),
                saved.getPrice(),
                saved.getStock(),
                saved.getCreatedAt());
    }
}