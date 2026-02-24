package com.shoestore.shoestore.controller;

import com.shoestore.shoestore.entity.User;
import com.shoestore.shoestore.service.UserService;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api/auth")
public class AuthController {

    private final UserService userService;

    public AuthController(UserService userService) {
        this.userService = userService;
    }

    @PostMapping("/login")
    public Object login(@RequestParam String email,
            @RequestParam String password) {

        User user = userService.login(email, password);

        if (user == null) {
            return "Invalid credentials";
        }

        return user;
    }

    @PostMapping("/register")
    public Object register(@RequestBody User user) {

        

        User createdUser = userService.register(user);
        System.out.println("PASSWORD RECIBIDA: " + user.getPassword());

        if (createdUser == null) {
            return "Email already exists";
        }

        return createdUser;
    }
}