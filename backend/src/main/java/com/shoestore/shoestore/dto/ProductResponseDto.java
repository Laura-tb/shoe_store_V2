package com.shoestore.shoestore.dto;

import java.math.BigDecimal;
import java.time.LocalDateTime;

public class ProductResponseDto {

    private Integer id;
    private String image;
    private String name;
    private BigDecimal price;
    private Integer stock;
    private LocalDateTime createdAt;

    public ProductResponseDto(Integer id, String image, String name,
                              BigDecimal price, Integer stock,
                              LocalDateTime createdAt) {
        this.id = id;
        this.image = image;
        this.name = name;
        this.price = price;
        this.stock = stock;
        this.createdAt = createdAt;
    }

    public Integer getId() { return id; }
    public String getImage() { return image; }
    public String getName() { return name; }
    public BigDecimal getPrice() { return price; }
    public Integer getStock() { return stock; }
    public LocalDateTime getCreatedAt() { return createdAt; }
}