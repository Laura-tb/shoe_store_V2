package com.shoestore.shoestore.controller;

import com.shoestore.shoestore.service.ProductService;
import com.shoestore.shoestore.service.UserService;

import jakarta.validation.Valid;

import org.springframework.web.bind.annotation.*;

import java.util.List;

import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;

import com.shoestore.shoestore.dto.UserResponseDto;
import com.shoestore.shoestore.dto.ProductResponseDto;
import com.shoestore.shoestore.dto.ProductRequestDto;

@RestController
@RequestMapping("/admin")
public class AdminController {

    private final ProductService productService;
    private final UserService userService;

    public AdminController(ProductService productService,
            UserService userService) {
        this.productService = productService;
        this.userService = userService;
    }

    // ===== PRODUCTS =====
    @GetMapping("/products")
    public ResponseEntity<List<ProductResponseDto>> getAllProducts() {
        return ResponseEntity.ok(productService.findAllDto());
    }

    @PostMapping("/products")
    public ResponseEntity<ProductResponseDto> createProduct(
        @Valid @RequestBody ProductRequestDto dto) {

        return ResponseEntity
                .status(HttpStatus.CREATED)
                .body(productService.create(dto));
    }

    @PutMapping("/products/{id}")
    public ResponseEntity<ProductResponseDto> updateProduct(
        @PathVariable Integer id,
        @Valid @RequestBody ProductRequestDto dto) {

        return ResponseEntity.ok(productService.update(id, dto));
    }

    @DeleteMapping("/products/{id}")
    public ResponseEntity<Void> deleteProduct(@PathVariable Integer id) {
        boolean deleted = productService.deleteIfExists(id);

        if (!deleted) {
            return ResponseEntity.status(HttpStatus.NOT_FOUND).build();
        }

        return ResponseEntity.noContent().build(); // 204
    }

    // ===== USERS =====

    @GetMapping("/users")
    public ResponseEntity<List<UserResponseDto>> getAllUsers() {
        return ResponseEntity.ok(userService.findAllUsersDto());
    }

    @DeleteMapping("/users/{id}")
    public ResponseEntity<Void> deleteUser(@PathVariable Integer id) {
        boolean deleted = userService.deleteIfExists(id);

        if (!deleted) {
            return ResponseEntity.status(HttpStatus.NOT_FOUND).build();
        }

        return ResponseEntity.noContent().build();
    }
}