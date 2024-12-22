<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    public function index()
    {
        try {
            // Lấy tất cả danh mục từ bảng categories
            $categories = Category::all();

            // Duyệt qua từng danh mục để thêm đường dẫn đầy đủ cho thumbnail
            $categories->transform(function ($category) {
                $category->thumbnail = $category->thumbnail
                    ? url('storage/categories/' . $category->thumbnail)
                    : null;
                return $category;
            });

            // Trả về danh sách danh mục dưới dạng JSON
            return response()->json([
                'success' => true,
                'data' => $categories,
            ], 200);

        } catch (\Exception $e) {
            // Xử lý lỗi nếu có
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch categories',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        // Kiểm tra quyền truy cập
        $user = Auth::user(); // Lấy thông tin người dùng hiện tại
        if ($user->role_id !== 1) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Only admins can add categories'
            ], 403);
        }

        // Validate dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Xử lý ảnh thumbnail
            $thumbnailPath = null;
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('categories', 'public');
            }

            // Lưu danh mục vào cơ sở dữ liệu
            $category = Category::create([
                'name' => $request->name,
                'description' => $request->description,
                'thumbnail' => $thumbnailPath ? basename($thumbnailPath) : null,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Category added successfully',
                'data' => $category,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add category',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
