package com.shoestore.shoestore.controller;

import com.shoestore.shoestore.entity.User;
import com.shoestore.shoestore.service.UserService;
import org.springframework.web.bind.annotation.*;

import org.springframework.http.ResponseEntity;
import org.springframework.http.HttpStatus;

//DTOs
import com.shoestore.shoestore.dto.RegisterRequestDto;
import com.shoestore.shoestore.dto.LoginRequestDto;
import com.shoestore.shoestore.dto.AuthResponseDto;

@RestController
@RequestMapping("/api/auth")
public class AuthController {

    private final UserService userService;

    public AuthController(UserService userService) {
        this.userService = userService;
    }

    @PostMapping("/login")
    public ResponseEntity<?> login(@RequestBody LoginRequestDto dto) {

        User user = userService.login(dto.getEmail(), dto.getPassword());

        if (user == null) {
            return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body("Invalid credentials");
        }

        AuthResponseDto response = new AuthResponseDto(
                user.getId(),
                user.getEmail(),
                user.getName(),
                user.getSurname(),
                user.getRole(),
                user.getCreatedAt());

        return ResponseEntity.ok(response);
    }

    @PostMapping("/register")
    public ResponseEntity<?> register(@RequestBody RegisterRequestDto dto) {

        User createdUser = userService.registerFromDto(dto);

        if (createdUser == null) {
            return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Email already exists");
        }

        AuthResponseDto response = new AuthResponseDto(
                createdUser.getId(),
                createdUser.getEmail(),
                createdUser.getName(),
                createdUser.getSurname(),
                createdUser.getRole(),
                createdUser.getCreatedAt());

        return ResponseEntity.status(HttpStatus.CREATED).body(response);
    }

}