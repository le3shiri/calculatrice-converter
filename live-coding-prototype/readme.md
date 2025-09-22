# Decimal Converter & Bitwise Operations

## 📌 Project Description
This project is a simple **number converter and bitwise operations tool** written in PHP.  
It allows you to:
- Convert **decimal numbers** to:
  - **Binary** (base 2)
  - **Hexadecimal** (base 16)
- Perform **bitwise operations**:
  - **AND**
  - **OR**
  - **XOR**

⚡ All conversions and operations are implemented **manually**, without using built-in functions like `bin()`, `hex()`,  

---

## 🚀 Features
- Decimal → Binary (custom function)
- Decimal → Hexadecimal (custom function)
- Bitwise operations between two binary numbers:
  - **AND** → returns `1` only if both bits are `1`
  - **OR** → returns `1` if at least one bit is `1`
  - **XOR** → returns `1` only if bits are different
- User-friendly CLI (Command Line Interface)
- Clean and easy-to-read code

---

## 🛠️ Functions

### 1. `decimal_to_binary(n)`
Converts decimal → binary using repeated division by 2.

### 2. `decimal_to_hexadecimal(n)`
Converts decimal → hexadecimal using repeated division by 16 and a dictionary mapping.

### 3. `binary_and(b1, b2)`
Performs **AND** operation on two binary strings.  
Pads them to the same length → loops bit by bit → returns result.

### 4. `binary_or(b1, b2)`
Performs **OR** operation on two binary strings.  
Pads them to the same length → loops bit by bit → returns result.

### 5. `binary_xor(b1, b2)`
Performs **XOR** operation on two binary strings.  
Pads them to the same length → loops bit by bit → returns result.


---


