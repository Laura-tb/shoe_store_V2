package com.shoestore.shoestore.dto;

import java.time.LocalDateTime;

public class AuthResponseDto {
    private Integer id;
    private String email;
    private String name;
    private String surname;
    private String role;
    private LocalDateTime createdAt;

    public AuthResponseDto(Integer id, String email, String name, String surname, String role, LocalDateTime createdAt) {
        this.id = id;
        this.email = email;
        this.name = name;
        this.surname = surname;
        this.role = role;
        this.createdAt = createdAt;
    }

    public Integer getId() { return id; }
    public String getEmail() { return email; }
    public String getName() { return name; }
    public String getSurname() { return surname; }
    public String getRole() { return role; }
    public LocalDateTime getCreatedAt() { return createdAt; }
}