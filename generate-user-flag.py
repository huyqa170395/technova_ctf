import hashlib
import random
import string

def generate_random_string(length):
    characters = string.ascii_letters + string.digits
    return ''.join(random.choice(characters) for _ in range(length))

def generate_hash(data):
    sha256 = hashlib.sha256()
    sha256.update(data.encode('utf-8'))
    return sha256.hexdigest()

def main():
    # Số lượng mã hash bạn muốn tạo
    num_hashes = 1

    with open("user.txt", "w") as file:
        for _ in range(num_hashes):
            # Tạo một chuỗi ngẫu nhiên (ví dụ: 10 ký tự)
            random_string = generate_random_string(7)
            
            # Tạo mã hash cho chuỗi ngẫu nhiên
            hashed_value = generate_hash(random_string)
            
            # Lưu mã hash vào file user.txt
            file.write(hashed_value + "\n")

if __name__ == "__main__":
    main()