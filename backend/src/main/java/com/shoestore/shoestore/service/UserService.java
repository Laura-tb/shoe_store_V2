package com.shoestore.shoestore.service;

import com.shoestore.shoestore.entity.User;
import com.shoestore.shoestore.repository.UserRepository;
import org.springframework.stereotype.Service;
import org.springframework.security.crypto.password.PasswordEncoder;

import java.util.Optional;
import java.time.LocalDateTime;
import java.util.List;

import com.shoestore.shoestore.dto.UserResponseDto;
import java.util.stream.Collectors;

import com.shoestore.shoestore.dto.RegisterRequestDto;

@Service
public class UserService {

    private final UserRepository repository;
    private final PasswordEncoder passwordEncoder;

    public UserService(UserRepository repository,
            PasswordEncoder passwordEncoder) {
        this.repository = repository;
        this.passwordEncoder = passwordEncoder;
    }

    public User login(String email, String password) {

        Optional<User> userOptional = repository.findByEmail(email);

        if (userOptional.isPresent()) {
            User user = userOptional.get();

            if (passwordEncoder.matches(password, user.getPassword())) {
                return user;
            }
        }

        return null;
    }

    public User register(User user) {

        if (repository.findByEmail(user.getEmail()).isPresent()) {
            return null;
        }

        user.setPassword(passwordEncoder.encode(user.getPassword()));
        user.setRole("ROLE_CLIENT");

        return repository.save(user);
    }

    public List<User> findAll() {
        return repository.findAll();
    }

    public void delete(Integer id) {
        repository.deleteById(id);
    }

    public boolean deleteIfExists(Integer id) {
        if (!repository.existsById(id))
            return false;
        repository.deleteById(id);
        return true;
    }

    public List<UserResponseDto> findAllDto() {
        return repository.findAll()
                .stream()
                .map(u -> new UserResponseDto(
                        u.getId(),
                        u.getEmail(),
                        u.getName(),
                        u.getSurname(),
                        u.getRole(),
                        u.getCreatedAt()))
                .collect(Collectors.toList());
    }

    public User registerFromDto(RegisterRequestDto dto) {

        if (repository.findByEmail(dto.getEmail()).isPresent()) {
            return null;
        }

        User user = new User();
        user.setEmail(dto.getEmail());
        user.setName(dto.getName());
        user.setSurname(dto.getSurname());
        user.setPassword(passwordEncoder.encode(dto.getPassword()));
        user.setRole("ROLE_CLIENT");
        user.setCreatedAt(LocalDateTime.now()); // si tu columna es NOT NULL

        return repository.save(user);
    }


    public List<UserResponseDto> findAllUsersDto() {

    return repository.findAll()
            .stream()
            .map(user -> new UserResponseDto(
                    user.getId(),
                    user.getEmail(),
                    user.getName(),
                    user.getSurname(),
                    user.getRole(),
                    user.getCreatedAt()
            ))
            .collect(Collectors.toList());
}
}