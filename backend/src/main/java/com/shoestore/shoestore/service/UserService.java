package com.shoestore.shoestore.service;

import com.shoestore.shoestore.entity.User;
import com.shoestore.shoestore.repository.UserRepository;
import org.springframework.stereotype.Service;

import java.util.Optional;
import java.time.LocalDateTime;

import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder; // para hashing de contraseñas

@Service
public class UserService {

    private final UserRepository userRepository;

    public UserService(UserRepository userRepository) {
        this.userRepository = userRepository;
    }

    public User login(String email, String password) {

        Optional<User> userOptional = userRepository.findByEmail(email);

        if (userOptional.isPresent()) {
            User user = userOptional.get();

            if (passwordEncoder.matches(password, user.getPassword())) {
                return user;
            }
        }

        return null;
    }

    private final BCryptPasswordEncoder passwordEncoder = new BCryptPasswordEncoder();

    public User register(User user) {

        user.setCreatedAt(LocalDateTime.now());
        user.setRole("client");

        if (userRepository.findByEmail(user.getEmail()).isPresent()) {
            return null;
        }

        // HASH AQUÍ
        user.setPassword(passwordEncoder.encode(user.getPassword()));

        return userRepository.save(user);
    }
}